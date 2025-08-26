<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Define model policies here, if any
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Gate for admin users
        Gate::define('access-admin', function (User $user) {
            return $user->is_active && $user->is_admin;
        });

        // Gate for normal users
        Gate::define('access-user', function (User $user) {
            return $user->is_active && !$user->is_admin;
        });
    }
}
