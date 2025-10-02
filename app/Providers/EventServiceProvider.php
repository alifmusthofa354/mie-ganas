<?php

namespace App\Providers;

use App\Events\LoginFailed;
use App\Events\LoginSuccessful;
use App\Listeners\LogFailedLoginAttempt;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\UpdateLastLogin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoginFailed::class => [
            LogFailedLoginAttempt::class,
        ],
        LoginSuccessful::class => [
            LogSuccessfulLogin::class,
            UpdateLastLogin::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}