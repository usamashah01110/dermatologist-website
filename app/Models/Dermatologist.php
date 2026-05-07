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
}
