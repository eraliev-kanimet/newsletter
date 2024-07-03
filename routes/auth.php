<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(RegisterController::class)
        ->prefix('register')
        ->name('register.')
        ->group(function () {
            Route::get('', 'page')->name('page');
            Route::post('', 'order')->name('order');
            Route::get('{token}', 'action')->name('action');
        });

    Route::controller(LoginController::class)
        ->prefix('login')
        ->name('login.')
        ->group(function () {
            Route::get('', 'page')->name('page');
            Route::post('', 'action')->name('action');
        });

    Route::controller(ForgotPasswordController::class)
        ->prefix('forgot-password')
        ->name('forgot-password.')
        ->group(function () {
            Route::get('', 'page')->name('page');
            Route::post('', 'action')->name('action');
        });

    Route::controller(PasswordResetController::class)
        ->prefix('password-reset')
        ->name('password-reset.')
        ->group(function () {
            Route::get('', 'page')->name('page');
            Route::post('', 'action')->name('action');
        });
});
