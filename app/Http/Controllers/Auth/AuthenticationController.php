<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\LoginRateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    use LoginRateLimiter;

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        $captcha = $this->getCaptcha();
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
        $this->validateCaptcha($request);

        // Process login
        if (Auth::attempt($credentials)) {
            // Clear rate limiter on successful login
            $this->clearRateLimits($rateLimitData['keyUser'], $rateLimitData['keyIp']);

            $request->session()->regenerate();

            $user = Auth::user();
            $validRoles = ['admin', 'cashier', 'waiter', 'chef'];
            $role = in_array($user->role, $validRoles) ? $user->role : 'dashboard';

            return redirect()->intended('/' . $role);
        }

        // Record failed login attempt
        $this->recordFailedLoginAttempt(
            $rateLimitData['keyUser'], 
            $rateLimitData['keyIp'], 
            $rateLimitData['decaySeconds']
        );

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