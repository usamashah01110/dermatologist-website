<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name:string,email:string,phone:?string,subject:string,message:string}  $data
     */
    public function __construct(public array $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact form: ' . $this->data['subject'],
            // Sent from the app's configured address (the SMTP account owns it),
            // but replying goes straight back to the visitor.
            replyTo: [new Address($this->data['email'], $this->data['name'])],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message',
            with: [
                'name'    => $this->data['name'],
                'email'   => $this->data['email'],
                'phone'   => $this->data['phone'] ?? null,
                'subject' => $this->data['subject'],
                // Not "message" — Laravel reserves that variable in mail views.
                'body'    => $this->data['message'],
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
