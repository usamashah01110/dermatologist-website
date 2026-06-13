<?php

namespace App\Mail;

use App\Models\Dermatologist;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
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
            subject: 'Your DermaConnect profile has been approved 🎉',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.dermatologist-approved',
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
