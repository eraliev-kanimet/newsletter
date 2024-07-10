<?php


namespace App\Services\Models\SendingProcess;

use App\Contracts\Mail\MailServiceInterface;
use App\Contracts\SendingProcess\SendingProcessServiceInterface;
use App\Enums\SendingProcessStatus;
use App\Mail\BaseMail;
use App\Models\SendingProcess;

class SendingProcessService implements SendingProcessServiceInterface
{
    public function __construct(
        protected MailServiceInterface $mailService
    )
    {
    }

    protected SendingProcess $process;

    public function get(): SendingProcess
    {
        return $this->process;
    }

    public function set(SendingProcess $process): static
    {
        $this->process = $process;

        return $this;
    }

    public function sendToMail(): static
    {
        $message = $this->process->message;

        $mailable = new BaseMail($message['subject'], $message['text'], $message['html']);

        $this->mailService
            ->to($this->receivers())
            ->setMailable($mailable)
            ->send();

        return $this;
    }

    public function completed(): static
    {
        $this->process->update([
            'status' => SendingProcessStatus::completed->value,
        ]);

        return $this;
    }

    protected function receivers(): array
    {
        return $this->process->receivers->pluck('email')->toArray();
    }
}
