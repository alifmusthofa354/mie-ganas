<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

trait LoginRateLimiter
{
    /**
     * Check and apply rate limiting for login attempts
     *
     * @param Request $request
     * @throws ValidationException
     */
    protected function checkLoginRateLimit(Request $request)
    {
        $ip = $request->ip();
        $email = strtolower($request->input('email'));

        // Account-specific key (IP + email)
        $keyUser = 'login-user:' . $ip . '|' . $email;
        // Global key per IP
        $keyIp = 'login-ip:' . $ip;

        // Attempt limits
        $maxAttemptsUser = 5;   // per user per IP
        $maxAttemptsIp = 20;    // per IP for all accounts
        $decaySeconds = 60;     // reset after 60 seconds

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

        // Return the keys so they can be used for incrementing or clearing later
        return [
            'keyUser' => $keyUser,
            'keyIp' => $keyIp,
            'decaySeconds' => $decaySeconds
        ];
    }

    /**
     * Record failed login attempt
     *
     * @param string $keyUser
     * @param string $keyIp
     * @param int $decaySeconds
     */
    protected function recordFailedLoginAttempt(string $keyUser, string $keyIp, int $decaySeconds)
    {
        // Login failed → hit both limiters
        RateLimiter::hit($keyUser, $decaySeconds);
        RateLimiter::hit($keyIp, $decaySeconds);

        // Can add CAPTCHA trigger here
        if (RateLimiter::attempts($keyUser) >= 3) {
            // For example, set a flag in session to show captcha in form
            session(['show_captcha' => true]);
        }
    }

    /**
     * Clear rate limits after successful login
     */
    protected function clearRateLimits(string $keyUser, string $keyIp)
    {
        RateLimiter::clear($keyUser);
        RateLimiter::clear($keyIp);
    }
}