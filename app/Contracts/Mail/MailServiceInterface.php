<?php

namespace App\Contracts\Mail;

use Illuminate\Contracts\Mail\Mailable;

interface MailServiceInterface
{
    public function setMailable(Mailable $mailable): static;

    public function to(mixed $users): static;

    public function send(): void;
}
