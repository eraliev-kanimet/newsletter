<?php

use App\Console\Commands\SendingProcessCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::call(SendingProcessCommand::class)->everyThirtyMinutes();
