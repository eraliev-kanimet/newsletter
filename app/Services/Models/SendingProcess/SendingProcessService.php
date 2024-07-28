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
        $message = $this->process->message;

        $receivers = $this->process
            ->receivers()
            ->whereIsActive(true)
            ->whereNotNull('data->email')
            ->get();

        foreach ($receivers as $receiver) {
            $this->mailService
                ->to($receiver->data['email'])
                ->setMailable($this->createMessage($message, $receiver->data))
                ->send();
        }

        return $this;
    }

    public function completed(): static
    {
        $this->process->update([
            'status' => SendingProcessStatus::completed->value,
        ]);

        return $this;
    }

    protected function createMessage(array $data, array $receiver): BaseMail
    {
        $message = [
            'subject' => $data['subject'],
            'text' => $data['text'],
            'html' => $data['html'],
        ];

        $placeholders = [];

        foreach ($receiver as $key => $value) {
            $placeholders['{{' . $key . '}}'] = $value;
        }

        foreach ($message as $key => $value) {
            $message[$key] = preg_replace_callback(
                '/{{([a-z_]+)}}/i',
                fn($matches) => $placeholders[$matches[0]] ?? $matches[0],
                $value
            );
        }

        return new BaseMail($message['subject'], $message['text'], $message['html']);
    }
}
