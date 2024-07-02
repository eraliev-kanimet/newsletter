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
        $routes = [
            'register' => 'register',
            'login' => 'login',
            'forgot-password' => 'forgotPassword',
            'password-reset' => 'passwordReset',
        ];

        foreach ($routes as $key => $value) {
            Route::prefix($key)->name("$key.")->group(function () use ($value) {
                Route::get('', "{$value}Page")->name('page');
                Route::post('', "{$value}Action")->name('action');
            });
        }
    });
