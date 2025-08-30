<?php

namespace App\Providers;

use App\Models\User;
use App\Enums\UserTypeEnum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('access-admin-panel', function (User $user) {
            return $user->user_type instanceof UserTypeEnum && $user->user_type->value === 'admin';
        });

        Gate::define('access-user-panel', function (User $user) {
            return $user->user_type instanceof UserTypeEnum && $user->user_type->value === 'user';
        });

        Gate::define('access-reader-panel', function (User $user) {
            return $user->user_type instanceof UserTypeEnum && $user->user_type->value === 'reader';
        });
    }
}
