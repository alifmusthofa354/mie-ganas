<?php

namespace App\Traits;

use App\Helpers\LoginRateLimiterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $keyUser = 'login_attempts_user_' . sha1($ip . '|' . $email);
        // Global key per IP
        $keyIp = 'login_attempts_ip_' . sha1($ip);

        // Get limits from configuration
        $maxAttemptsUser = config('login.rate_limits.user_attempts', 5);
        $maxAttemptsIp = config('login.rate_limits.ip_attempts', 20);
        $decaySeconds = config('login.rate_limits.decay_seconds', 60);

        // Check if user has reached the limit
        LoginRateLimiterHelper::checkRateLimit(
            $keyUser,
            $maxAttemptsUser,
            'Too many login attempts for this account. Please wait '
        );

        // Check if IP has reached global limit
        LoginRateLimiterHelper::checkRateLimit(
            $keyIp,
            $maxAttemptsIp,
            'Too many login attempts from this IP. Please wait '
        );

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
        LoginRateLimiterHelper::recordFailedAttempt($keyUser, $decaySeconds);
        LoginRateLimiterHelper::recordFailedAttempt($keyIp, $decaySeconds);

        // Get attempts required to trigger CAPTCHA from config
        $captchaAfterAttempts = config('login.rate_limits.captcha_after_attempts', 3);

        // Trigger CAPTCHA after configured number of failed attempts
        if (LoginRateLimiterHelper::getAttempts($keyUser) >= $captchaAfterAttempts) {
            Session::put(config('login.session.captcha_flag'), true);
        }
    }

    /**
     * Clear rate limits after successful login
     */
    protected function clearRateLimits(string $keyUser, string $keyIp)
    {
        LoginRateLimiterHelper::clearRateLimit($keyUser);
        LoginRateLimiterHelper::clearRateLimit($keyIp);
        // Also clear captcha flag on successful login
        Session::forget(config('login.session.captcha_flag'));
    }

    /**
     * Check if CAPTCHA is required for this request
     */
    protected function isCaptchaRequired(): bool
    {
        return Session::get(config('login.session.captcha_flag'), false);
    }

    /**
     * Validate CAPTCHA if required - this method will be called with the service instance
     */
    protected function validateCaptchaWithService(Request $request, $captchaService): void
    {
        if ($this->isCaptchaRequired()) {
            $request->validate([
                'captcha' => 'required|string'
            ], [
                'captcha.required' => 'Please complete the CAPTCHA verification.'
            ]);

            // Verify the CAPTCHA answer
            if (!$captchaService->verify($request->input('captcha'))) {
                throw ValidationException::withMessages([
                    'captcha' => 'The CAPTCHA answer is incorrect. Please try again.'
                ]);
            }
        }
    }

    /**
     * Generate CAPTCHA if required - this method will be called with the service instance
     */
    public function getCaptchaWithService($captchaService): ?array
    {
        if ($this->isCaptchaRequired()) {
            return $captchaService->generate();
        }

        return null;
    }
}