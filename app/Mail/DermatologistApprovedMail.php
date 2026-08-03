<?php

namespace App\Mail;

use App\Models\Dermatologist;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DermatologistApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Dermatologist $dermatologist)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // Always send as the mailbox that owns the SMTP credentials. Gmail
            // and most providers reject (or spam-fold) a message whose From
            // header is not the authenticated sender — such a message still
            // shows up in the sender's own inbox but reaches nobody else.
            from: new Address(
                config('mail.from.address'),
                config('mail.from.name'),
            ),
            // Replies go to the support inbox, not the no-reply sender.
            replyTo: [new Address(config('mail.contact_to'), config('mail.from.name'))],
            subject: 'Your DermaConnect profile has been approved 🎉',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.dermatologist-approved',
            // A plain-text alternative turns this into a proper multipart
            // message. HTML-only mail from a fresh sender is a strong spam
            // signal, so this matters for delivery, not just for old clients.
            text: 'emails.dermatologist-approved-text',
            with: [
                'dermatologist' => $this->dermatologist,
                'doctorName'    => optional($this->dermatologist->user)->name ?? 'Doctor',
                'loginUrl'      => route('login'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
