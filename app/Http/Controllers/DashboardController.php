<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dermatologist;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Role-aware admin dashboard with real counts (no more dummy figures).
     */
    public function index(Request $request)
    {
        $user  = $request->user();
        $today = Carbon::today()->toDateString();
        $role  = 'patient';
        $stats = [];

        if ($user->hasRole('superadmin')) {
            $role  = 'superadmin';
            $stats = [
                'doctors'           => Dermatologist::count(),
                'pending_doctors'   => Dermatologist::where('status', 'pending')->count(),
                'patients'          => Patient::count(),
                'appointments'      => Appointment::count(),
                'today'             => Appointment::whereDate('appointment_date', $today)->count(),
                'pending'           => Appointment::where('status', 'pending')->count(),
            ];
        } elseif ($user->hasRole('dermatologist') && $user->dermatologist) {
            $role          = 'dermatologist';
            $dermatologist = $user->dermatologist;
            $base          = Appointment::where('dermatologist_id', $dermatologist->id);

            $stats = [
                'today'     => (clone $base)->whereDate('appointment_date', $today)->count(),
                'upcoming'  => (clone $base)->whereDate('appointment_date', '>', $today)
                    ->whereIn('status', ['pending', 'confirmed'])->count(),
                'pending'   => (clone $base)->where('status', 'pending')->count(),
                'total'     => (clone $base)->count(),
                'patients'  => (clone $base)->distinct('patient_id')->count('patient_id'),
                'remaining' => max(0, AppointmentController::MAX_PER_DAY
                    - (clone $base)->whereDate('appointment_date', $today)
                        ->whereIn('status', ['pending', 'confirmed'])->count()),
                'status'    => $dermatologist->status,
            ];
        } elseif ($user->hasRole('patient') && $user->patient) {
            $role = 'patient';
            $base = Appointment::where('patient_id', $user->patient->id);

            $stats = [
                'total'    => (clone $base)->count(),
                'upcoming' => (clone $base)->whereDate('appointment_date', '>=', $today)
                    ->whereIn('status', ['pending', 'confirmed'])->count(),
                'pending'  => (clone $base)->where('status', 'pending')->count(),
                'completed' => (clone $base)->where('status', 'completed')->count(),
            ];
        }

        return view('admin.dashboard', compact('user', 'role', 'stats'));
    }
}
