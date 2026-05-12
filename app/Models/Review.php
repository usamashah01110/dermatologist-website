<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'dermatologist_id',
        'patient_id',
        'name',
        'review_text',
        'location',
        'rating',
        'status',
    ];

    public function dermatologist()
    {
        return $this->belongsTo(Dermatologist::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // ── Scope for approved reviews only ──
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}

