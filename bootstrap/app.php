<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsActive;
use Illuminate\Foundation\Application;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['auth', 'active', 'admin'])
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
            Route::middleware(['auth', 'active'])
                ->prefix('user')
                ->group(base_path('routes/user.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => IsAdmin::class,
            'active' => IsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();