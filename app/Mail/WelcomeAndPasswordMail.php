<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class WelcomeAndPasswordMail extends Mailable
{
    use Queueable;

    public function __construct(
        public string $password,
    )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('message.welcome.1'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.auth.welcome_and_password',
            with: [
                'password' => $this->password,
            ]
        );
    }
}
