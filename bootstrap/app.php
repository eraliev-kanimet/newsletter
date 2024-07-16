<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Support\Facades\Route;

$middlewares = require __DIR__ . '/../bootstrap/middlewares.php';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('web')->group(function () {
                require_once base_path('routes/web.php');

                Route::name('auth.')->group(base_path('routes/auth.php'));
            });

            Route::middleware('api')->prefix('api')->name('api.')->group(function () {
                require_once base_path('routes/api/index.php');

                Route::prefix('auth')->name('auth.')->group(base_path('routes/api/auth.php'));
            });
        },
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware($middlewares)
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
