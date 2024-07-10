<?php

namespace App\Console\Commands;

use App\Contracts\SendingProcess\SendingProcessServiceInterface;
use App\Enums\SendingProcessStatus;
use App\Models\SendingProcess;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class SendingProcessCommand extends Command
{
    protected $signature = 'app:sending-process {--now}';

    public function handle(): void
    {
        $service = app(SendingProcessServiceInterface::class);

        foreach ($this->get() as $process) {
            $service->set($process);

            $service->sendToMail();

            $service->completed();
        }
    }

    protected function get(): Collection
    {
        $query = SendingProcess::query()
            ->with(['receivers'])
            ->whereStatus(SendingProcessStatus::pending->value)
            ->limit(50);

        if ($this->option('now')) {
            return $query->get();
        }

        return $query
            ->where('when', '<=', now())
            ->get();
    }
}
