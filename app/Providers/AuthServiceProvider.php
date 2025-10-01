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
        Gate::define('view-admin-dashboard', function (User $user) {
            return $user->role === 'admin'
                ? Response::allow()
                : Response::deny('Only Admins can access this page.');
        });

        Gate::define('view-cashier-dashboard', function (User $user) {
            return $user->role === 'cashier'
                ? Response::allow()
                : Response::deny('Only Cashiers can access this page.');
        });

        Gate::define('view-waiter-dashboard', function (User $user) {
            return $user->role === 'waiter'
                ? Response::allow()
                : Response::deny('Only Waiters can access this page.');
        });

        Gate::define('view-chef-dashboard', function (User $user) {
            return $user->role === 'chef'
                ? Response::allow()
                : Response::deny('Only Chefs can access this page.');
        });
    }
}
