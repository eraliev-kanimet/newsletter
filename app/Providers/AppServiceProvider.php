<?php

namespace App\Providers;

use App\Contracts\Auth\PasswordResetServiceInterface;
use App\Contracts\Mail\MailServiceInterface;
use App\Contracts\SendingProcess\SendingProcessServiceInterface;
use App\Contracts\User\ApiUserGetServiceInterface;
use App\Contracts\User\UserCreateServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Contracts\User\UserUpdateServiceInterface;
use App\Services\Auth\PasswordResetService;
use App\Services\Mail\MailService;
use App\Services\Models\Api\User\UserGetService;
use App\Services\Models\SendingProcess\SendingProcessService;
use App\Services\Models\User\UserCreateService;
use App\Services\Models\User\UserService;
use App\Services\Models\User\UserUpdateService;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(MailServiceInterface::class, MailService::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserCreateServiceInterface::class, UserCreateService::class);
        $this->app->bind(UserUpdateServiceInterface::class, UserUpdateService::class);

        $this->app->bind(ApiUserGetServiceInterface::class, UserGetService::class);

        $this->app->bind(SendingProcessServiceInterface::class, SendingProcessService::class);

        $this->app->bind(PasswordResetServiceInterface::class, PasswordResetService::class);
    }

    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(fn() => route(config('routes.web.home')));
    }
}
