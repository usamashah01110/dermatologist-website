<?php

namespace App\Http\Controllers;

use App\Models\Dermatologist;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage users');
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Figure out which roles were selected so we know whether we also have to
        // create a linked patient / dermatologist profile row.
        $roles = $request->has('roles')
            ? Role::whereIn('id', $request->roles)->get()
            : collect();
        $roleNames = $roles->pluck('name');

        $isPatient       = $roleNames->contains('patient');
        $isDermatologist = $roleNames->contains('dermatologist');

        // Conditionally validate the profile fields for the chosen role(s).
        if ($isPatient) {
            $request->validate([
                'phone_number' => 'required|string|max:20',
                'age'          => 'required|integer|min:1|max:120',
                'gender'       => 'required|in:Male,Female,Other,Prefer not to say',
                'address'      => 'nullable|string|max:1000',
                'skin_type'    => 'nullable|in:Normal,Oily,Dry,Combination,Sensitive,Not sure',
            ]);
        }

        if ($isDermatologist) {
            $request->validate([
                'qualification'       => 'required|string|max:255',
                'experience_year'     => 'required|string',
                'specialization'      => 'required|string',
                'derma_phone_number'  => 'required|string|max:30',
                'clinic_address'      => 'required|string|max:500',
                'city'                => 'required|string',
                'availability_days'   => 'required|array|min:1',
                'availability_days.*' => 'string',
                'profile_image'       => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'status'              => 'required|in:pending,approved,rejected',
            ]);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->syncRoles($roles);

            if ($isPatient) {
                Patient::create([
                    'user_id'      => $user->id,
                    'phone_number' => $request->phone_number,
                    'age'          => $request->age,
                    'gender'       => $request->gender,
                    'address'      => $request->address,
                    'skin_type'    => $request->skin_type,
                ]);
            }

            if ($isDermatologist) {
                $imagePath = $request->file('profile_image')->store('dermatologists', 'public');

                Dermatologist::create([
                    'user_id'           => $user->id,
                    'qualification'     => $request->qualification,
                    'experience_year'   => $request->experience_year,
                    'specialization'    => $request->specialization,
                    'phone_number'      => $request->derma_phone_number,
                    'clinic_address'    => $request->clinic_address,
                    'city'              => $request->city,
                    'availability_days' => $request->availability_days,
                    'profile_image'     => $imagePath,
                    'status'            => $request->status,
                ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Admin User Create Error: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Something went wrong while creating the user. Please try again.');
        }

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);
        $roles = Role::whereIn('id', $request->roles ?? [])->get();
        $user->syncRoles($roles);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
