<?php

namespace App\Providers;

use App\Services\ViaCepService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registro do ViaCepService
        $this->app->bind(ViaCepService::class, function ($app) {
            return new ViaCepService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
