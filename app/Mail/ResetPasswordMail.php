<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ResetPasswordMail extends Mailable
{
    use Queueable;

    public function __construct(
        public string $resetLink,
    )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('common.reset_password'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.auth.reset-password',
            with: [
                'resetLink' => $this->resetLink,
            ]
        );
    }
}
