<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('view-admin-dashboard', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('view-cashier-dashboard', function (User $user) {
            return $user->role === 'cashier';
        });

        Gate::define('view-waiter-dashboard', function (User $user) {
            return $user->role === 'waiter';
        });

        Gate::define('view-chef-dashboard', function (User $user) {
            return $user->role === 'chef';
        });
    }
}
