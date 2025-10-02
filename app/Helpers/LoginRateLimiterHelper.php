<?php

namespace App\Helpers;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRateLimiterHelper
{
    /**
     * Check rate limit and throw exception if exceeded
     * 
     * @param string $key The rate limiter key
     * @param int $maxAttempts Maximum allowed attempts
     * @param string $errorMessage Error message template
     * @throws ValidationException
     */
    public static function checkRateLimit(string $key, int $maxAttempts, string $errorMessage): void
    {
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            throw ValidationException::withMessages([
                'email' => $errorMessage . RateLimiter::availableIn($key) . ' seconds.'
            ]);
        }
    }

    /**
     * Record failed attempt for a given key
     */
    public static function recordFailedAttempt(string $key, int $decaySeconds): void
    {
        RateLimiter::hit($key, $decaySeconds);
    }

    /**
     * Clear rate limit for a given key
     */
    public static function clearRateLimit(string $key): void
    {
        RateLimiter::clear($key);
    }

    /**
     * Get number of attempts for a key
     */
    public static function getAttempts(string $key): int
    {
        return RateLimiter::attempts($key) ?? 0;
    }

    /**
     * Check if rate limit is exceeded for a key
     */
    public static function isRateLimited(string $key, int $maxAttempts): bool
    {
        return RateLimiter::tooManyAttempts($key, $maxAttempts);
    }
}