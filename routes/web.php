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
        Route::prefix('register')->name('register.')->group(function () {
            Route::get('', 'registerPage')->name('page');
            Route::post('', 'registerAction')->name('action');
        });

        Route::prefix('login')->name('login.')->group(function () {
            Route::get('', 'loginPage')->name('page');
            Route::post('', 'loginAction')->name('action');
        });

        Route::prefix('forgot-password')->name('forgot-password.')->group(function () {
            Route::get('', 'forgotPasswordPage')->name('page');
            Route::post('', 'forgotPasswordAction')->name('action');
        });
    });
