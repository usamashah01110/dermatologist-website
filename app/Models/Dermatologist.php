<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
