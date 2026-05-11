<?php

namespace App\Http\Controllers;

use App\Models\Dermatologist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

    public function detailDermatologist($id)
    {
        $doctor = Dermatologist::with('user')->where('status', 'approved')->where('id', $id)->first();

        return view('dermatologistdetailpage', compact('doctor'));

    }
        public function edit($id)
        {
            $dermatologist=Dermatologist::findOrFail($id);
            return view('admin.dermatologist.edit', compact('dermatologist'));
        }

    public function update(Request $request, $id)
    {
        $dermatologist = Dermatologist::findOrFail($id);
        $dermatologist->status = $request->status;
        $dermatologist->save();

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
                    'availability_days' => $validated['availability_days'],
                    'profile_image'     => $imagePath,
                    'status'            => 'pending',
                ]);

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
