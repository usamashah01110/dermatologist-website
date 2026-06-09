<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dermatologist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Maximum appointments a single doctor can take in one day.
     */
    public const MAX_PER_DAY = 15;

    public function __construct()
    {
        // Every action here requires an authenticated user.
        $this->middleware('auth');
    }

    /**
     * Admin-panel appointment list, scoped by the viewer's role.
     *
     *  - superadmin     → every appointment
     *  - dermatologist  → only their own appointments (defaults to today)
     *  - patient        → only their own appointments
     *
     * An optional ?date=YYYY-MM-DD filter narrows the list to a single day.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $date = $request->input('date');

        $query = Appointment::with(['patient.user', 'dermatologist.user'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc');

        if ($user->hasRole('superadmin')) {
            // Admin sees everything – no extra scoping.
        } elseif ($user->hasRole('dermatologist')) {
            $dermatologist = $user->dermatologist;

            if (! $dermatologist) {
                abort(403, 'No dermatologist profile is linked to your account.');
            }

            $query->where('dermatologist_id', $dermatologist->id);

            // Doctors land on "today" by default; they can filter to older days.
            if (! $date) {
                $date = Carbon::today()->toDateString();
            }
        } elseif ($user->hasRole('patient')) {
            $patient = $user->patient;

            if (! $patient) {
                abort(403, 'No patient profile is linked to your account.');
            }

            $query->where('patient_id', $patient->id);
        } else {
            abort(403, 'You are not allowed to view appointments.');
        }

        if ($date) {
            $query->whereDate('appointment_date', $date);
        }

        $appointments = $query->get();

        // Small summary used by the status cards on the page.
        $stats = [
            'total'     => $appointments->count(),
            'pending'   => $appointments->where('status', 'pending')->count(),
            'confirmed' => $appointments->where('status', 'confirmed')->count(),
            'completed' => $appointments->where('status', 'completed')->count(),
            'cancelled' => $appointments->where('status', 'cancelled')->count(),
        ];

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'date'         => $date,
            'stats'        => $stats,
            'isPatient'    => $user->hasRole('patient'),
        ]);
    }

    /**
     * Store a new appointment (called from the public booking form).
     *
     * The availability checks and the insert run inside one locked
     * transaction so two concurrent requests can never push a doctor past
     * the daily cap or double-book the same time slot.
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

        if (! $patient) {
            return back()
                ->withInput()
                ->with('error', 'Patient profile not found. Please complete your registration first.');
        }

        $dermatologist = Dermatologist::with('user')->find($validated['dermatologist_id']);

        // The doctor must actually work on the chosen weekday.
        if (! empty($dermatologist->availability_days)) {
            $weekday = Carbon::parse($validated['appointment_date'])->format('l');

            if (! in_array($weekday, $dermatologist->availability_days, true)) {
                $days = implode(', ', $dermatologist->availability_days);

                return back()
                    ->withInput()
                    ->with('error', "Dr. {$dermatologist->user->name} is not available on {$weekday}. Available days: {$days}.");
            }
        }

        DB::beginTransaction();

        try {
            // Lock the doctor's rows for this date so concurrent bookings serialize.
            $sameDay = Appointment::where('dermatologist_id', $validated['dermatologist_id'])
                ->whereDate('appointment_date', $validated['appointment_date'])
                ->whereIn('status', ['pending', 'confirmed'])
                ->lockForUpdate()
                ->get();

            if ($sameDay->count() >= self::MAX_PER_DAY) {
                DB::rollBack();

                return back()
                    ->withInput()
                    ->with('error', 'Sorry, this doctor is fully booked on the selected date. Please choose another date.');
            }

            $slotTaken = $sameDay->contains(
                fn ($a) => substr((string) $a->appointment_time, 0, 5) === $validated['appointment_time']
            );

            if ($slotTaken) {
                DB::rollBack();

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

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while booking. Please try again.');
        }

        return redirect()
            ->route('home.page')
            ->with('success', 'Appointment requested successfully! We\'ll confirm within 24 hours.');
    }

    /**
     * Update an appointment's status.
     *
     *  - superadmin / owning doctor → any status
     *  - owning patient             → may only cancel
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
        ]);

        $user = $request->user();

        $isOwningDoctor  = $user->hasRole('dermatologist')
            && optional($user->dermatologist)->id === $appointment->dermatologist_id;
        $isOwningPatient = $user->hasRole('patient')
            && optional($user->patient)->id === $appointment->patient_id;

        $canManage = $user->hasRole('superadmin') || $isOwningDoctor;

        if (! $canManage && ! ($isOwningPatient && $data['status'] === 'cancelled')) {
            abort(403, 'You are not allowed to change this appointment.');
        }

        $appointment->update(['status' => $data['status']]);

        return back()->with('success', "Appointment marked as {$data['status']}.");
    }

    /**
     * AJAX endpoint — remaining slots for a given doctor + date.
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
            'max'       => self::MAX_PER_DAY,
            'remaining' => max(0, self::MAX_PER_DAY - $booked),
            'is_full'   => $booked >= self::MAX_PER_DAY,
        ]);
    }
}
