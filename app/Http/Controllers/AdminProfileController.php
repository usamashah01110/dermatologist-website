<?php

namespace App\Http\Controllers;

use App\Models\Dermatologist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the unified profile page for the logged-in user
     * (superadmin, dermatologist or patient).
     */
    public function edit(Request $request)
    {
        $user = $request->user()->load(['dermatologist', 'patient', 'roles']);

        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update account details + any role-specific profile fields.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $user->name = $request->name;

        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Dermatologist-specific fields. A user can hold the dermatologist role
        // without a profile record yet (e.g. created via the admin Users page) —
        // in that case completing this form CREATES the profile (pending review).
        if ($user->hasRole('dermatologist')) {
            $data = $request->validate([
                'qualification'       => ['required', 'string', 'max:255'],
                'experience_year'     => ['required', 'string', 'max:255'],
                'specialization'      => ['required', 'string', 'max:255'],
                'phone_number'        => ['required', 'string', 'max:30'],
                'clinic_address'      => ['required', 'string', 'max:500'],
                'city'                => ['required', 'string', 'max:255'],
                'availability_days'   => ['required', 'array', 'min:1'],
                'availability_days.*' => ['string'],
                'profile_image'       => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            ]);

            $payload = [
                'qualification'     => $data['qualification'],
                'experience_year'   => $data['experience_year'],
                'specialization'    => $data['specialization'],
                'phone_number'      => $data['phone_number'],
                'clinic_address'    => $data['clinic_address'],
                'city'              => $data['city'],
                'availability_days' => array_values($data['availability_days']),
            ];

            if ($request->hasFile('profile_image')) {
                $payload['profile_image'] = $request->file('profile_image')->store('dermatologists', 'public');
            }

            if ($user->dermatologist) {
                $user->dermatologist->update($payload);

                return back()->with('success', 'Dermatologist profile updated successfully.');
            }

            $payload['user_id'] = $user->id;
            $payload['status']  = 'pending';
            Dermatologist::create($payload);

            return back()->with('success', 'Your dermatologist profile has been submitted and is pending admin approval. Once approved it will appear in the public directory.');
        }

        // Patient-specific fields.
        if ($user->hasRole('patient') && $user->patient) {
            $data = $request->validate([
                'phone_number' => ['nullable', 'string', 'max:20'],
                'age'          => ['nullable', 'integer', 'min:1', 'max:120'],
                'gender'       => ['nullable', 'in:Male,Female,Other,Prefer not to say'],
                'address'      => ['nullable', 'string', 'max:1000'],
                'skin_type'    => ['nullable', 'in:Normal,Oily,Dry,Combination,Sensitive,Not sure'],
            ]);

            $user->patient->update($data);
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}
