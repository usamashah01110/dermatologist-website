<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'dermatologist_id',
        'patient_name',
        'patient_email',
        'patient_phone',
        'preferred_contact',
        'is_new_patient',
        'appointment_type',
        'appointment_date',
        'appointment_time',
        'concern_category',
        'notes',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'is_new_patient'   => 'boolean',
    ];

    // ── Relationships ──
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function dermatologist()
    {
        return $this->belongsTo(Dermatologist::class);
    }
}
