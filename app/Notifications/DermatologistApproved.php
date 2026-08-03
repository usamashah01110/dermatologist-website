<?php

namespace App\Notifications;

use App\Mail\DermatologistApprovedMail;
use App\Models\Dermatologist;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * Tells a dermatologist their profile has been approved.
 *
 * Deliberately NOT a ShouldQueue notification: the admin screen reports whether
 * the mail server really accepted the message, and a queued send would always
 * report success. Add `implements ShouldQueue` once a queue worker is running.
 */
class DermatologistApproved extends Notification
{
    use Queueable;

    public function __construct(public Dermatologist $dermatologist)
    {
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): DermatologistApprovedMail
    {
        // The recipient comes from the notifiable itself (User::$email), so the
        // address can never drift away from the account being approved.
        return (new DermatologistApprovedMail($this->dermatologist))
            ->to($notifiable->email, $notifiable->name);
    }
}
