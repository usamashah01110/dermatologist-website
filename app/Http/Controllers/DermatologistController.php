<?php

namespace App\Http\Controllers;

use App\Models\Dermatologist;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class DermatologistController extends Controller

{
    public function adminindex()
    {
        $doctors=Dermatologist::with('user')->get();
        return view('admin.dermatologist.index',compact('doctors'));
    }


    public function index(Request $request)
    {
       return view('registerdematologist');
    }

    /**
     * Admin: show the form to create a new dermatologist.
     */
    public function create()
    {
        return view('admin.dermatologist.create');
    }

    /**
     * Admin: store a new dermatologist (user + dermatologist profile).
     */
    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'             => ['required', 'string', 'min:8', 'confirmed'],
            'qualification'        => ['required', 'string', 'max:255'],
            'experience_year'      => ['required', 'string'],
            'specialization'       => ['required', 'string'],
            'phone_number'         => ['required', 'string', 'max:30'],
            'clinic_address'       => ['required', 'string', 'max:500'],
            'city'                 => ['required', 'string'],
            'consultation_fee'     => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'availability_days'    => ['required', 'array', 'min:1'],
            'availability_days.*'  => ['string'],
            'profile_image'        => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'status'               => ['required', 'in:pending,approved,rejected'],
        ]);

        try {
            $imagePath = $request->file('profile_image')->store('dermatologists', 'public');

            $dermatologist = DB::transaction(function () use ($validated, $imagePath) {
                $user = User::create([
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]);

                $dermatologist = Dermatologist::create([
                    'user_id'           => $user->id,
                    'qualification'     => $validated['qualification'],
                    'experience_year'   => $validated['experience_year'],
                    'specialization'    => $validated['specialization'],
                    'phone_number'      => $validated['phone_number'],
                    'clinic_address'    => $validated['clinic_address'],
                    'city'              => $validated['city'],
                    'consultation_fee'  => $validated['consultation_fee'] ?? null,
                    'availability_days' => $validated['availability_days'],
                    'profile_image'     => $imagePath,
                    'status'            => $validated['status'],
                ]);

                Role::firstOrCreate(['name' => 'dermatologist', 'guard_name' => 'web']);
                $user->assignRole('dermatologist');

                return $dermatologist->setRelation('user', $user);
            });

            // Created straight into the approved state — notify them right away.
            // Sent after the transaction commits so we never email about a
            // profile that ended up rolled back.
            if ($dermatologist->status === 'approved') {
                if ($dermatologist->sendApprovalNotification()) {
                    return redirect()->route('dermatologist.index')
                        ->with('success', "Dermatologist created and approved. Approval email sent to {$dermatologist->user->email}.");
                }

                return redirect()->route('dermatologist.index')
                    ->with('error', 'Dermatologist created and approved, but the approval email could not be sent. Check the mail settings in .env and storage/logs/laravel.log.');
            }

            return redirect()->route('dermatologist.index')
                ->with('success', 'Dermatologist created successfully.');
        } catch (\Exception $e) {
            Log::error('Admin Dermatologist Create Error: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Something went wrong while creating the dermatologist. Please try again.');
        }
    }

    public function detailDermatologist($id)
    {
        $doctor = Dermatologist::with('user')->where('status', 'approved')->where('id', $id)->first();
        $userReview = Review::where('dermatologist_id', $id)->get();
        return view('dermatologistdetailpage', compact('doctor','userReview'));

    }
        public function edit($id)
        {
            $dermatologist=Dermatologist::findOrFail($id);
            return view('admin.dermatologist.edit', compact('dermatologist'));
        }

    public function update(Request $request, $id)
    {
        $dermatologist = Dermatologist::with('user')->findOrFail($id);

        $request->validate([
            'consultation_fee' => ['nullable', 'integer', 'min:0', 'max:1000000'],
        ]);

        $previousStatus = $dermatologist->status;
        $dermatologist->status = $request->status;

        if ($request->has('consultation_fee')) {
            $dermatologist->consultation_fee = $request->consultation_fee !== null && $request->consultation_fee !== ''
                ? $request->consultation_fee
                : null;
        }

        $dermatologist->save();

        // Notify the dermatologist by email the moment their profile is approved
        // (only on the transition into "approved", so re-saving an approved
        // profile does not spam them).
        if ($request->status === 'approved' && $previousStatus !== 'approved') {
            if ($dermatologist->sendApprovalNotification()) {
                return redirect()->route('dermatologist.index')
                    ->with('success', "Dermatologist approved. Approval email sent to {$dermatologist->user->email}.");
            }

            return redirect()->route('dermatologist.index')
                ->with('error', 'Dermatologist approved, but the approval email could not be sent. Check the mail settings in .env and storage/logs/laravel.log.');
        }

        return redirect()->route('dermatologist.index')->with('success', 'Dermatologist status updated successfully.');
    }

    public function destroy($id)
    {
        $dermatologist = Dermatologist::findOrFail($id);

        if ($dermatologist->user) {
            $dermatologist->user->delete();
        }

        $dermatologist->delete();

        return redirect()->route('dermatologist.index')->with('success', 'Dermatologist deleted successfully.');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'             => ['required', 'string', 'min:8', 'confirmed'],
            'qualification'        => ['required', 'string', 'max:255'],
            'experience_year'      => ['required', 'string'],
            'specialization'       => ['required', 'string'],
            'phone_number'         => ['required', 'string', 'max:30'],
            'clinic_address'       => ['required', 'string', 'max:500'],
            'city'                 => ['required', 'string'],
            'consultation_fee'     => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'availability_days'    => ['required', 'array', 'min:1'],
            'availability_days.*'  => ['string'],
            'profile_image'        => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'terms'                => ['accepted'],
        ]);

        try {

            $imagePath = $request->file('profile_image')
                ->store('dermatologists', 'public');

            DB::transaction(function () use ($validated, $imagePath) {

                $user = User::create([
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]);

                Dermatologist::create([
                    'user_id'           => $user->id,
                    'qualification'     => $validated['qualification'],
                    'experience_year'   => $validated['experience_year'],
                    'specialization'    => $validated['specialization'],
                    'phone_number'      => $validated['phone_number'],
                    'clinic_address'    => $validated['clinic_address'],
                    'city'              => $validated['city'],
                    'consultation_fee'  => $validated['consultation_fee'] ?? null,
                    'availability_days' => $validated['availability_days'],
                    'profile_image'     => $imagePath,
                    'status'            => 'pending',
                ]);

                Role::firstOrCreate(['name' => 'dermatologist', 'guard_name' => 'web']);
                $user->assignRole('dermatologist');

                return $user;
            });

            if ($request->ajax()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Your dermatologist application has been submitted successfully. Our admin team will review and approve your profile shortly.',
                    'redirect' => url('/')
                ]);
            }



        } catch (\Exception $e) {

            Log::error('Dermatologist Registration Error: ' . $e->getMessage());

            // AJAX Error Response
            if ($request->ajax()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong while submitting your application. Please try again.'
                ], 500);
            }

            return back()->with(
                'error',
                'Something went wrong. Please try again.'
            );
        }
    }
}
