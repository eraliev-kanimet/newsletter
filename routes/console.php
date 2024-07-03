<?php

use App\Console\Commands\DeleteUnnecessaryDataCommand;
use App\Console\Commands\SendingProcessCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::call(SendingProcessCommand::class)->everyThirtyMinutes();
Schedule::call(DeleteUnnecessaryDataCommand::class)->everyThirtyMinutes();
