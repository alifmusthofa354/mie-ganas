<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Customer Token Cookie Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk cookie customer anonim yang digunakan untuk
    | melacak riwayat pelanggan.
    |
    */

    'token_cookie_name' => env('CUSTOMER_TOKEN_COOKIE_NAME', 'customer_token'),

    'token_cookie_expiration' => env('CUSTOMER_TOKEN_COOKIE_EXPIRATION', 60 * 24 * 365), // 1 tahun dalam menit

    'token_cookie_secure' => env('CUSTOMER_TOKEN_COOKIE_SECURE', true),

    'token_cookie_http_only' => env('CUSTOMER_TOKEN_COOKIE_HTTP_ONLY', true),

    'token_cookie_same_site' => env('CUSTOMER_TOKEN_COOKIE_SAME_SITE', 'lax'),
];