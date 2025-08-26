<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Políticas de modelo, se houver
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Gate para administradores
        Gate::define('access-admin', function (User $user) {
            return $user->is_active && $user->is_admin;
        });

        // Gate para usuários normais
        Gate::define('access-user', function (User $user) {
            return $user->is_active && !$user->is_admin;
        });
    }
}
