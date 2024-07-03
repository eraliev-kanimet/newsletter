<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class UserCreationOrderMail extends Mailable
{
    use Queueable;

    public function __construct(
        public string $link
    )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('common.registration'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.auth.register',
            with: [
                'link' => $this->link,
            ],
        );
    }
}
