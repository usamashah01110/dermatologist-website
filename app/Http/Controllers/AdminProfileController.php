<?php

namespace App\Http\Controllers;

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

        // Dermatologist-specific fields.
        if ($user->hasRole('dermatologist') && $user->dermatologist) {
            $data = $request->validate([
                'phone_number'    => ['nullable', 'string', 'max:30'],
                'qualification'   => ['nullable', 'string', 'max:255'],
                'specialization'  => ['nullable', 'string', 'max:255'],
                'experience_year' => ['nullable', 'string', 'max:255'],
                'clinic_address'  => ['nullable', 'string', 'max:500'],
                'city'            => ['nullable', 'string', 'max:255'],
            ]);

            $user->dermatologist->update($data);
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
