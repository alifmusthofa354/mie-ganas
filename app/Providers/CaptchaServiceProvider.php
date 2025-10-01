<?php

namespace App\Providers;

use App\Contracts\CaptchaServiceContract;
use App\Services\MewsCaptchaService;
use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the CAPTCHA service contract to the implementation
        $this->app->bind(CaptchaServiceContract::class, MewsCaptchaService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
