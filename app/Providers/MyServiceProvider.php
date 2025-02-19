<?php

namespace App\Providers;

use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureReader;
use App\Http\Middleware\EnsureUser;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
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
        //
    }
}
