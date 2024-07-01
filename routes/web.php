<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('set/locale/{locale}', [SiteController::class, 'locale'])
    ->whereIn('locale', array_keys(config('app.locales')))
    ->name('set.locale');

Route::controller(AuthController::class)
    ->name('auth.')
    ->middleware(['guest'])
    ->group(function () {
        Route::get('/register', 'registerPage')->name('register.page');
        Route::post('/register', 'registerAction')->name('register.action');
    });
