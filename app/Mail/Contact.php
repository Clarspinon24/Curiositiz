<?php

namespace App\Mail;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected ContactFormRequest $contactFormRequest
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->contactFormRequest->subject . ' - Curiositiz.com',
            replyTo: [$this->contactFormRequest->email],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'firstname' => $this->contactFormRequest->firstname,
                'lastname'  => $this->contactFormRequest->lastname,
                'email'     => $this->contactFormRequest->email,
                'subject'   => $this->contactFormRequest->subject,
                'content'   => $this->contactFormRequest->message,
            ],
        );
    }
}
