<?php

use App\Http\Middleware\LanguageMiddleware;
use Illuminate\Foundation\Configuration\Middleware;

return function (Middleware $middleware) {
    $middleware->redirectGuestsTo(fn() => route('auth.login.page'));

    $middleware->web([
        LanguageMiddleware::class,
    ]);
};
