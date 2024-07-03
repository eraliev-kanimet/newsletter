<?php

namespace App\Contracts\Mail;

use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Mail\PendingMail;

interface MailServiceInterface
{
    public function setPendingMail(PendingMail $pendingMail): static;

    public function setMailable(Mailable $mailable): static;

    public function to(mixed $users): static;

    public function send(): void;
}
