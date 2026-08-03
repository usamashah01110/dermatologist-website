<?php

namespace App\Models;

use App\Mail\DermatologistApprovedMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        if (! $this->user || ! $this->user->email) {
            Log::warning("Dermatologist approval email skipped: no email on dermatologist #{$this->id}.");

            return false;
        }

        try {
            Mail::to($this->user->email)->send(new DermatologistApprovedMail($this));

            return true;
        } catch (\Throwable $e) {
            Log::error('Dermatologist approval email failed: ' . $e->getMessage());

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
