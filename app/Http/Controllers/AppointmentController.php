<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Apply auth middleware only to booking & store.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['showBookingPage', 'store']);
    }

    /**
     * Show the booking page (with optional pre-selected doctor).
     */
    public function showBookingPage($doctor = null)
    {
        $selectedDoctor = null;

        if ($doctor) {
            $selectedDoctor = User::with('dermatologist')
                ->where('name', $doctor)
                ->first();
        }

        return view('appointments.booking', compact('selectedDoctor'));
    }

    /**
     * Store a new appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dermatologist_id'  => ['required', 'exists:dermatologists,id'],
            'patient_name'      => ['required', 'string', 'max:255'],
            'patient_email'     => ['required', 'email', 'max:255'],
            'patient_phone'     => ['required', 'string', 'max:20'],
            'preferred_contact' => ['required', 'in:phone,email,whatsapp'],
            'is_new_patient'    => ['nullable', 'boolean'],
            'appointment_type'  => ['required', 'in:consultation,follow_up,treatment,emergency'],
            'appointment_date'  => ['required', 'date', 'after_or_equal:today'],
            'appointment_time'  => ['required', 'date_format:H:i'],
            'concern_category'  => ['nullable', 'string', 'max:100'],
            'notes'             => ['nullable', 'string', 'max:2000'],
        ]);

        $patient = Auth::user()->patient;

        if (!$patient) {
            return back()
                ->withInput()
                ->with('error', 'Patient profile not found. Please complete your registration first.');
        }

        $existingCount = Appointment::where('dermatologist_id', $validated['dermatologist_id'])
            ->whereDate('appointment_date', $validated['appointment_date'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        if ($existingCount >= 15) {
            return back()
                ->withInput()
                ->with('error', 'Sorry, this doctor is fully booked on the selected date. Please choose another date.');
        }

        $duplicateSlot = Appointment::where('dermatologist_id', $validated['dermatologist_id'])
            ->whereDate('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($duplicateSlot) {
            return back()
                ->withInput()
                ->with('error', 'This time slot is already booked. Please pick a different time.');
        }

        Appointment::create([
            'patient_id'        => $patient->id,
            'dermatologist_id'  => $validated['dermatologist_id'],
            'patient_name'      => $validated['patient_name'],
            'patient_email'     => $validated['patient_email'],
            'patient_phone'     => $validated['patient_phone'],
            'preferred_contact' => $validated['preferred_contact'],
            'is_new_patient'    => $request->boolean('is_new_patient'),
            'appointment_type'  => $validated['appointment_type'],
            'appointment_date'  => $validated['appointment_date'],
            'appointment_time'  => $validated['appointment_time'],
            'concern_category'  => $validated['concern_category'] ?? null,
            'notes'             => $validated['notes'] ?? null,
            'status'            => 'pending',
        ]);

        return redirect()
            ->route('home.page')
            ->with('success', 'Appointment requested successfully! We\'ll confirm within 24 hours.');
    }

    /**
     * AJAX endpoint — check availability for a given date + doctor.
     * Used by the JS in the booking form.
     */
    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'dermatologist_id' => ['required', 'exists:dermatologists,id'],
            'date'             => ['required', 'date'],
        ]);

        $booked = Appointment::where('dermatologist_id', $validated['dermatologist_id'])
            ->whereDate('appointment_date', $validated['date'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        return response()->json([
            'booked'    => $booked,
            'max'       => 15,
            'remaining' => max(0, 15 - $booked),
            'is_full'   => $booked >= 15,
        ]);
    }
}
