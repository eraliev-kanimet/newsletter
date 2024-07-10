<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Support\Facades\Route;

$middlewares = require __DIR__ . '/../bootstrap/middlewares.php';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->name('auth.')->group(base_path('routes/auth.php'));
        },
    )
    ->withMiddleware($middlewares)
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
