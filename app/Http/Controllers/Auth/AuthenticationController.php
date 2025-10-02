<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\CaptchaServiceContract;
use App\Events\LoginFailed;
use App\Events\LoginSuccessful;
use App\Http\Controllers\Controller;
use App\Traits\LoginRateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    use LoginRateLimiter;

    protected $captchaService;

    public function __construct(CaptchaServiceContract $captchaService)
    {
        $this->captchaService = $captchaService;
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        $captcha = $this->getCaptchaWithService($this->captchaService);
        return view('auth.login', compact('captcha'));
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check rate limiting
        $rateLimitData = $this->checkLoginRateLimit($request);

        // Validate CAPTCHA if required
        $this->validateCaptchaWithService($request, $this->captchaService);

        // Prepare login credentials with remember option
        $remember = $request->has('remember');
        
        // Process login
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            
            // Check if user account is active after successful authentication
            if (!$user->is_active) {
                // Logout user immediately
                Auth::logout();
                
                // Record failed login attempt (user exists but is inactive)
                $this->recordFailedLoginAttempt(
                    $rateLimitData['keyUser'], 
                    $rateLimitData['keyIp'], 
                    $rateLimitData['decaySeconds']
                );

                // Dispatch failed login event
                LoginFailed::dispatch($request->input('email'), $request->ip(), $request->userAgent());

                throw ValidationException::withMessages([
                    'email' => 'Your account has been deactivated. Please contact administrator.',
                ]);
            }

            // Clear rate limiter on successful login (for active users)
            $this->clearRateLimits($rateLimitData['keyUser'], $rateLimitData['keyIp']);

            $request->session()->regenerate();

            $validRoles = ['admin', 'cashier', 'waiter', 'chef'];
            $role = in_array($user->role, $validRoles) ? $user->role : 'dashboard';

            // Dispatch successful login event
            LoginSuccessful::dispatch($user, $request->ip(), $request->userAgent());

            return redirect()->intended('/' . $role);
        }

        // Record failed login attempt
        $this->recordFailedLoginAttempt(
            $rateLimitData['keyUser'], 
            $rateLimitData['keyIp'], 
            $rateLimitData['decaySeconds']
        );

        // Dispatch failed login event
        LoginFailed::dispatch($request->input('email'), $request->ip(), $request->userAgent());

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.',
        ]);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}