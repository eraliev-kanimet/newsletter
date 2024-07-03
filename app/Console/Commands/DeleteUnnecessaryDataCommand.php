<?php

namespace App\Console\Commands;

use App\Models\PasswordResetToken;
use App\Models\TimeData;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteUnnecessaryDataCommand extends Command
{
    protected $signature = 'app:delete-unnecessary-data';

    public function handle(): void
    {
        $expiryTime = Carbon::now()->subMinutes(30);

        TimeData::where('created_at', '<', $expiryTime)->limit(50)->delete();

        PasswordResetToken::where('created_at', '<', $expiryTime)->limit(50)->delete();
    }
}
