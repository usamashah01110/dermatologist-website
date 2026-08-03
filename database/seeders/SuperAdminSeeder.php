<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'dermatologist', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'patient', 'guard_name' => 'web']);

        // Create or get the role
        $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

        // Ensure there is at least one permission; if none exist, create a catch-all permission
        $permissions = Permission::all();
        if ($permissions->isEmpty()) {
            $permissions = collect([Permission::firstOrCreate(['name' => 'manage everything'])]);
        }

        // Assign all permissions to the role
        $role->syncPermissions($permissions);

        // Create the superadmin user (or get existing) with the requested password
        $user = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'superadmin',
                'password' => Hash::make('bscs093859'),
            ]
        );

        // Assign the role to the user
        if (! $user->hasRole('superadmin')) {
            $user->assignRole($role);
        }
    }
}
