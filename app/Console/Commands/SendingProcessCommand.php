<?php

namespace App\Console\Commands;

use App\Enums\SendingProcessStatus;
use App\Mail\SendingProcessMail;
use App\Models\SendingProcess;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class SendingProcessCommand extends Command
{
    protected $signature = 'app:sending-process {--now}';

    public function handle(): void
    {
        foreach ($this->get() as $process) {
            $mail = new SendingProcessMail(
                $process->message['subject'],
                $process->message['text'],
                $process->message['html'],
            );

            foreach ($process->receivers as $receiver) {
                Mail::to($receiver->email)->send($mail);
            }

            $process->update([
                'status' => SendingProcessStatus::completed->value,
            ]);
        }
    }

    public function get(): Collection
    {
        $query = SendingProcess::query()
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
