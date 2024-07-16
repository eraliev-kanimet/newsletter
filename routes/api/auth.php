<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('order', 'order')->name('order');
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::controller(PasswordController::class)->group(function () {
    Route::post('forgot', 'forgot')->name('forgot');
    Route::post('reset', 'reset')->name('reset');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
