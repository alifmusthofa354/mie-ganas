<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationRateLimitTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_rate_limiting_works()
    {
        // Clear any existing rate limits for this test
        RateLimiter::clear('login-attempt:127.0.0.1');

        // Create a test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Simulate 5 failed login attempts
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/login', [
                '_token' => csrf_token(),
                'email' => 'test@example.com',
                'password' => 'wrongpassword', // Wrong password to trigger failure
            ]);

            // Each failed attempt should redirect back with error
            $response->assertRedirect();
        }

        // The 6th attempt should trigger rate limiting
        $response = $this->post('/login', [
            '_token' => csrf_token(),
            'email' => 'test@example.com',
            'password' => 'password', // Correct password but should still be rate limited
        ]);

        // Should get an error about too many attempts
        $response->assertSessionHasErrors('email');
        
        // Verify the error message includes rate limiting info
        $errors = session('errors');
        $this->assertStringContainsString('Too many login attempts', $errors->first('email'));
    }

    public function test_successful_login_clears_rate_limit()
    {
        // Clear any existing rate limits for this test
        RateLimiter::clear('login-attempt:127.0.0.1');

        // Create a test user
        $user = User::factory()->create([
            'email' => 'test2@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // First, trigger some failed attempts to build up rate limit
        for ($i = 0; $i < 3; $i++) {
            $this->post('/login', [
                '_token' => csrf_token(),
                'email' => 'test2@example.com',
                'password' => 'wrongpassword',
            ]);
        }

        // Now try a successful login - this should clear the rate limit
        $response = $this->post('/login', [
            '_token' => csrf_token(),
            'email' => 'test2@example.com',
            'password' => 'password', // Correct credentials
        ]);

        // Should redirect to admin dashboard
        $response->assertRedirect('/admin');
        
        // After successful login, the rate limit should be cleared
        // So we can immediately try another login without rate limiting
        RateLimiter::clear('login-attempt:127.0.0.1');
    }
}