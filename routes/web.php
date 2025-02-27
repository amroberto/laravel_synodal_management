<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnpjController;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/consultar-cnpj', [CnpjController::class, 'consultar']);