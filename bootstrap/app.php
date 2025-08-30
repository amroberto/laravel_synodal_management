<?php

use App\Providers\AppServiceProvider;
use App\Http\Middleware\IsActive;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckUserAccess;
use App\Http\Middleware\CheckAdminAccess;
use App\Http\Middleware\CheckReaderAccess;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'access-user-panel' => CheckUserAccess::class,
            'access-reader-panel' => CheckReaderAccess::class,
            'access-admin-panel' => CheckAdminAccess::class,
            'active' => IsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withProviders([
        AppServiceProvider::class,
        \Barryvdh\DomPDF\ServiceProvider::class,
    ])->create();
