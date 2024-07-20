<?php

namespace App\Traits\Services\SendingProcess;

use App\Contracts\Mail\MailServiceInterface;
use App\Mail\BaseMail;
use App\Models\SendingProcess;

/**
 * @property SendingProcess $process
 * @property MailServiceInterface $mailService
 */
trait SendingProcessServiceTrait
{
    protected function receivers(): array
    {
        return $this->process->receivers->pluck('email')->toArray();
    }

    public function createMail(): MailServiceInterface
    {
        $message = $this->process->message;

        $mailable = new BaseMail($message['subject'], $message['text'], $message['html']);

        return $this->mailService
            ->to($this->receivers())
            ->setMailable($mailable);
    }
}
