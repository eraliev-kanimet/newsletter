<?php

namespace App\Console\Commands;

use App\Enums\SendingProcessStatus;
use App\Mail\SendingProcessMail;
use App\Models\SendingProcess;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendingProcessCommand extends Command
{
    protected $signature = 'app:sending-process';

    public function handle(): void
    {
        $processes = SendingProcess::whereStatus(SendingProcessStatus::pending->value)
            ->where('when', '<=', now())
            ->limit(50)
            ->get();

        foreach ($processes as $process) {
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
}
