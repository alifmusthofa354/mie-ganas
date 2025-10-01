<?php

namespace App\Providers;

use App\Contracts\CaptchaServiceContract;
use App\Services\SimpleCaptchaService;
use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the CAPTCHA service contract to the implementation
        $this->app->bind(CaptchaServiceContract::class, SimpleCaptchaService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
