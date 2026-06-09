<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Patients list for the admin panel.
     *
     *  - superadmin    → every patient
     *  - dermatologist → only patients who have booked with them
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('superadmin')) {
            $patients = Patient::with('user')
                ->withCount('appointments')
                ->latest()
                ->get();
        } elseif ($user->hasRole('dermatologist')) {
            $dermatologist = $user->dermatologist;

            if (! $dermatologist) {
                abort(403, 'No dermatologist profile is linked to your account.');
            }

            $patientIds = Appointment::where('dermatologist_id', $dermatologist->id)
                ->pluck('patient_id')
                ->unique();

            $patients = Patient::with('user')
                ->whereIn('id', $patientIds)
                // Count only appointments that belong to THIS doctor.
                ->withCount(['appointments' => function ($q) use ($dermatologist) {
                    $q->where('dermatologist_id', $dermatologist->id);
                }])
                ->latest()
                ->get();
        } else {
            abort(403, 'You are not allowed to view patients.');
        }

        return view('admin.patients.index', compact('patients'));
    }
}
