<?php

namespace App\Services\Mail;

use App\Contracts\Mail\MailServiceInterface;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Mail\PendingMail;
use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{
    protected PendingMail $pendingMail;

    protected Mailable $mailable;

    public function setPendingMail(PendingMail $pendingMail): static
    {
        $this->pendingMail = $pendingMail;

        return $this;
    }

    public function setMailable(Mailable $mailable): static
    {
        $this->mailable = $mailable;

        return $this;
    }

    public function to(mixed $users): static
    {
        return $this->setPendingMail(Mail::to($users));
    }

    public function send(): void
    {
        if (config('mail.enabled')) {
            $this->pendingMail->send($this->mailable);
        } else {
            dump(
                'THIS IS DONE TO DEBUG THE CODE! AFTER 10 SECONDS THE CODE WILL CONTINUE TO WORK!',
                $this->mailable
            );

            sleep(10);
        }
    }
}
