<?php

namespace App\Providers;

use App\Contracts\PasswordResetServiceInterface;
use App\Services\Auth\PasswordResetService;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PasswordResetServiceInterface::class, PasswordResetService::class);
    }

    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(fn () => route(config('routes.web.home')));
    }
}
