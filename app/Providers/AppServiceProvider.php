<?php

namespace App\Providers;

use App\Contracts\Auth\PasswordResetServiceInterface;
use App\Contracts\Mail\MailServiceInterface;
use App\Contracts\Message\ApiGetMessageServiceInterface;
use App\Contracts\Receiver\ApiGetReceiverServiceInterface;
use App\Contracts\SendingProcess\ApiGetSendingProcessServiceInterface;
use App\Contracts\SendingProcess\CreateSendingProcessServiceInterface;
use App\Contracts\SendingProcess\SendingProcessActivityChartInterface;
use App\Contracts\SendingProcess\SendingProcessServiceInterface;
use App\Contracts\SocialAccount\SocialAccountServiceInterface;
use App\Contracts\User\ApiGetUserServiceInterface;
use App\Contracts\User\ApiUserServiceInterface;
use App\Contracts\User\UserActivityChartServiceInterface;
use App\Contracts\User\UserCreateServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Contracts\User\UserUpdateServiceInterface;
use App\Services\Auth\PasswordResetService;
use App\Services\Mail\MailService;
use App\Services\Models\Api\Message\GetMessageService;
use App\Services\Models\Api\Receiver\GetReceiverService;
use App\Services\Models\Api\SendingProcess\GetSendingProcessService;
use App\Services\Models\Api\User\ApiUserService;
use App\Services\Models\Api\User\GetUserService;
use App\Services\Models\SendingProcess\CreateSendingProcessService;
use App\Services\Models\SendingProcess\SendingProcessActivityChartService;
use App\Services\Models\SendingProcess\SendingProcessService;
use App\Services\Models\SocialAccount\SocialAccountService;
use App\Services\Models\User\UserActivityChartService;
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
        $this->app->bind(UserActivityChartServiceInterface::class, UserActivityChartService::class);

        $this->app->bind(ApiUserServiceInterface::class, ApiUserService::class);
        $this->app->bind(ApiGetUserServiceInterface::class, GetUserService::class);

        $this->app->bind(SocialAccountServiceInterface::class, SocialAccountService::class);

        $this->app->bind(SendingProcessServiceInterface::class, SendingProcessService::class);
        $this->app->bind(CreateSendingProcessServiceInterface::class, CreateSendingProcessService::class);
        $this->app->bind(SendingProcessActivityChartInterface::class, SendingProcessActivityChartService::class);

        $this->app->bind(ApiGetSendingProcessServiceInterface::class, GetSendingProcessService::class);

        $this->app->bind(ApiGetMessageServiceInterface::class, GetMessageService::class);

        $this->app->bind(ApiGetReceiverServiceInterface::class, GetReceiverService::class);

        $this->app->bind(PasswordResetServiceInterface::class, PasswordResetService::class);
    }

    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(fn() => route(config('routes.web.home')));
    }
}
