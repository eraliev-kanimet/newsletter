<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendingProcessMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $_subject,
        public string $_text,
        public string $_html,
    )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->_subject,
        );
    }


    public function content(): Content
    {
        return new Content(
            html: 'mail.html',
            text: 'mail.text',
            with: [
                'subject' => $this->_subject,
                'html' => $this->_html,
                'text' => $this->_text,
            ],
        );
    }
}
