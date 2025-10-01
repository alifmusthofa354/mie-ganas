<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('has-role', function (User $user, string $role, ?string $message = null) {
            return $user->role === $role
                ? Response::allow()
                : Response::deny($message ?? 'You do not have permission to access this page.');
        });
    }
}
