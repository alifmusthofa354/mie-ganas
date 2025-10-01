<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
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

        // Start rate limiter
        $ip = $request->ip();
        $email = strtolower($request->input('email'));

        // Account-specific key (IP + email)
        $keyUser = 'login-user:' . $ip . '|' . $email;
        // Global key per IP
        $keyIp = 'login-ip:' . $ip;

        // Attempt limits
        $maxAttemptsUser = 5;   // per user per IP
        $maxAttemptsIp = 20;  // per IP for all accounts
        $decaySeconds = 60;  // reset after 60 seconds

        // Check if user has reached the limit
        if (RateLimiter::tooManyAttempts($keyUser, $maxAttemptsUser)) {
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts for this account. Please wait ' .
                    RateLimiter::availableIn($keyUser) . ' seconds.',
            ]);
        }

        // Check if IP has reached global limit
        if (RateLimiter::tooManyAttempts($keyIp, $maxAttemptsIp)) {
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts from this IP. Please wait ' .
                    RateLimiter::availableIn($keyIp) . ' seconds.',
            ]);
        }

        // Process login
        if (Auth::attempt($credentials)) {
            // Clear rate limiter on successful login
            RateLimiter::clear($keyUser);
            RateLimiter::clear($keyIp);

            $request->session()->regenerate();

            $user = Auth::user();
            $validRoles = ['admin', 'cashier', 'waiter', 'chef'];
            $role = in_array($user->role, $validRoles) ? $user->role : 'dashboard';

            return redirect()->intended('/' . $role);
        }

        // Login failed → hit both limiters
        RateLimiter::hit($keyUser, $decaySeconds);
        RateLimiter::hit($keyIp, $decaySeconds);

        // Can add CAPTCHA trigger here
        if (RateLimiter::attempts($keyUser) >= 3) {
            // For example, set a flag in session to show captcha in form
            session(['show_captcha' => true]);
        }

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