<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SynodController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;

// Todas as rotas de admin com middleware e prefixo
Route::middleware(['auth', 'verified', 'active', 'access-admin-panel'])
    ->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::resource('users', UserController::class)->names('admin.users');
        Route::resource('states', StateController::class)->names('admin.states');
        Route::resource('countries', CountryController::class)->names('admin.countries');
        Route::patch('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('admin.users.toggle-active');
        Route::resource('cities', CityController::class)->names('admin.cities');
        Route::resource('positions', PositionController::class)->names('admin.positions');
        
        // Rotas para edição do Sínodo
        Route::get('/synod/edit', [SynodController::class, 'edit'])->name('admin.synod.edit');
        Route::put('/synod', [SynodController::class, 'update'])->name('admin.synod.update');
    });
