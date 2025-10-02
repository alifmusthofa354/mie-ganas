<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Login Rate Limiting Configuration
    |--------------------------------------------------------------------------
    |
    | This option controls the rate limiting for login attempts.
    | You can configure the maximum attempts and decay time.
    |
    */

    'rate_limits' => [
        // Maximum login attempts per user from same IP
        'user_attempts' => env('LOGIN_USER_ATTEMPTS', 5),
        
        // Maximum login attempts per IP for all users
        'ip_attempts' => env('LOGIN_IP_ATTEMPTS', 20),
        
        // Time in seconds before rate limit resets
        'decay_seconds' => env('LOGIN_DECAY_SECONDS', 60),
        
        // Enable CAPTCHA after failed attempts
        'captcha_after_attempts' => env('LOGIN_CAPTCHA_AFTER_ATTEMPTS', 3),
    ],

    /*
    |--------------------------------------------------------------------------
    | Login Session Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for session management during login process.
    |
    */

    'session' => [
        // Session key for showing CAPTCHA
        'captcha_flag' => 'show_captcha',
        
        // Session key for CAPTCHA generation status
        'captcha_generated' => 'captcha_generated',
    ],
];