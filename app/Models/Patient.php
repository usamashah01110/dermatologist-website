<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'age',
        'gender',
        'address',
        'skin_type',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Always-renderable URL for the patient's photo.
     *
     * Same contract as Dermatologist::$profile_image_url — a missing column
     * value or a file that is no longer on disk falls back to the default
     * avatar instead of rendering a broken image.
     */
    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image && Storage::disk('public')->exists($this->profile_image)) {
            return asset('storage/' . $this->profile_image);
        }

        return asset('assets/img/avatars/1.png');
    }
}
