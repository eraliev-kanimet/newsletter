<?php

namespace App\Services\Models\User;

use App\Contracts\User\UserActivityChartServiceInterface;
use App\Models\User;
use App\Services\Abstract\ActivityChartService;
use Illuminate\Database\Eloquent\Builder;

class UserActivityChartService extends ActivityChartService implements UserActivityChartServiceInterface
{
    protected function query(): Builder
    {
        return User::query();
    }
}
