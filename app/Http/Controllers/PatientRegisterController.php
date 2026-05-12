<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PatientRegisterController extends Controller
{

        public function store(Request $request)
        {
            $validated = $request->validate([
                'name'              => ['required', 'string', 'max:255'],
                'email'             => ['required', 'email', 'max:255', 'unique:users,email'],
                'password'          => ['required', 'confirmed', Password::min(8)],
                'phone_number'      => ['required', 'string', 'max:20'],
                'age'               => ['required', 'integer', 'min:1', 'max:120'],
                'gender'            => ['required', 'in:Male,Female,Other,Prefer not to say'],
                'address'           => ['nullable', 'string', 'max:1000'],
                'skin_type'         => ['nullable', 'in:Normal,Oily,Dry,Combination,Sensitive,Not sure'],
                'terms'             => ['required', 'accepted'],
            ]);



            try {
                DB::beginTransaction();

                $user = User::create([
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]);

                Patient::create([
                    'user_id'      => $user->id,
                    'phone_number' => $validated['phone_number'],
                    'age'          => $validated['age'],
                    'gender'       => $validated['gender'],
                    'address'      => $validated['address'] ?? null,
                    'skin_type'    => $validated['skin_type'] ?? null,
                ]);

                $user->assignRole('patient');

                DB::commit();

                return redirect()
                    ->route('login')
                    ->with('success', 'Registration successful! Please login to continue.');

            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Registration failed. Please try again.');
            }
        }

}
