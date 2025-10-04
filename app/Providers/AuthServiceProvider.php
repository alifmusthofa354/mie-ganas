<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;
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
        $this->registerPolicies();

        Gate::define('has-role', function (User $user, string $role, ?string $message = null) {
            return $user->role === $role
                ? Response::allow()
                : Response::deny($message ?? 'You do not have permission to access this page.');
        });
    }

    /**
     * Register the application's policies.
     */
    public function registerPolicies(): void
    {
        Gate::policy(Category::class, CategoryPolicy::class);
    }
}
