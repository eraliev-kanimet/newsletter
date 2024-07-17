<?php

namespace App\Services\Models\SendingProcess;

use App\Contracts\SendingProcess\SendingProcessActivityChartInterface;
use App\Models\SendingProcess;
use App\Services\Abstract\ActivityChartService;
use Illuminate\Database\Eloquent\Builder;

class SendingProcessActivityChartService extends ActivityChartService implements SendingProcessActivityChartInterface
{
    protected function query(): Builder
    {
        return SendingProcess::query();
    }
}
