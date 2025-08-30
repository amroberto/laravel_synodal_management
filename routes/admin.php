<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;

// Todas as rotas de admin com middleware e prefixo
Route::middleware(['auth', 'verified', 'active', 'access-admin-panel'])
    ->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::resource('users', UserController::class)->names('admin.users');
        Route::resource('states', StateController::class)->names('admin.states');
        Route::patch('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('admin.users.toggle-active');
    });
