<?php


namespace App\Services\Models\SendingProcess;

use App\Contracts\Mail\MailServiceInterface;
use App\Contracts\SendingProcess\SendingProcessServiceInterface;
use App\Enums\SendingProcessStatus;
use App\Mail\BaseMail;
use App\Models\SendingProcess;
use App\Traits\Services\SendingProcess\SendingProcessServiceTrait;

class SendingProcessService implements SendingProcessServiceInterface
{
    use SendingProcessServiceTrait;

    public function __construct(
        protected MailServiceInterface $mailService
    )
    {
        //
    }

    protected SendingProcess $process;

    public function sendToMail(): static
    {
        $this->createMail()->send();

        return $this;
    }

    public function completed(): static
    {
        $this->process->update([
            'status' => SendingProcessStatus::completed->value,
        ]);

        return $this;
    }

    protected function createMail(): MailServiceInterface
    {
        $message = $this->process->message;

        $mailable = new BaseMail($message['subject'], $message['text'], $message['html']);

        return $this->mailService
            ->to($this->process->receivers()->pluck('email')->toArray())
            ->setMailable($mailable);
    }
}
