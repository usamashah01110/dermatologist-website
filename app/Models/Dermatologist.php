<?php

namespace App\Models;

use App\Notifications\DermatologistApproved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Dermatologist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qualification',
        'experience_year',
        'specialization',
        'phone_number',
        'clinic_address',
        'city',
        'consultation_fee',
        'availability_days',
        'profile_image',
        'status',
    ];

    protected $casts = [
        'availability_days' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Always-renderable URL for the profile photo.
     *
     * Guards the two cases that produced broken image icons: a record with no
     * `profile_image` at all (which turned into a bare "storage/" URL), and a
     * record whose file is no longer on disk. Built with asset() rather than
     * Storage::url() because the public disk's URL is pinned to APP_URL, which
     * breaks whenever the app is served from another host or port.
     */
    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image && Storage::disk('public')->exists($this->profile_image)) {
            return asset('storage/' . $this->profile_image);
        }

        return asset('assets/img/avatars/1.png');
    }

    /**
     * Email this dermatologist the "profile approved" notification.
     *
     * Call this from every place that can put a profile into the `approved`
     * state so the doctor always hears about it. Returns false (and logs)
     * instead of throwing, so a mail-server problem can never break the
     * approval itself.
     */
    public function sendApprovalNotification(): bool
    {
        $this->loadMissing('user');

        $email = $this->user?->email;

        if (! $email) {
            Log::warning("Dermatologist approval email skipped: no email on dermatologist #{$this->id}.");

            return false;
        }

        try {
            // Notifiable routes the mail to User::$email itself, so the
            // recipient can never drift from the account being approved.
            $this->user->notify(new DermatologistApproved($this));

            Log::info("Dermatologist approval email sent to {$email} (dermatologist #{$this->id}).");

            return true;
        } catch (\Throwable $e) {
            // Log the recipient and the mailer in use — without them a delivery
            // report of "it worked for me but not for them" is unreadable.
            Log::error("Dermatologist approval email to {$email} failed: " . $e->getMessage(), [
                'dermatologist_id' => $this->id,
                'mailer'           => config('mail.default'),
                'from'             => config('mail.from.address'),
            ]);

            return false;
        }
    }

// ⭐ Bonus: Average rating attribute
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->approved()->avg('rating') ?? 0;
    }

    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->approved()->count();
    }
}
