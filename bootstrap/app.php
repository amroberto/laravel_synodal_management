<?php

use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureReader;
use App\Http\Middleware\EnsureUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->trustProxies(at: '*');
        // $middleware->append([
        //     EnsureAdmin::class,
        //     EnsureUser::class,
        // ]);
        // $middleware->alias([
        //     'ensureAdmin' => EnsureAdmin::class,
        //     'ensureUser' => EnsureUser::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
