<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear Spatie's cached roles/permissions before seeding.
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'manage articles',
            'manage reviews',
            'manage diseases',
            'manage appointments',
            'view appointments',
            'view patients',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ── Superadmin: full access ──
        $superAdmin = Role::firstOrCreate(['name' => 'superadmin']);
        $superAdmin->syncPermissions(Permission::all());

        // ── Dermatologist: their own appointments & patients ──
        $dermatologist = Role::firstOrCreate(['name' => 'dermatologist']);
        $dermatologist->syncPermissions(['view appointments', 'view patients', 'manage appointments']);

        // ── Patient: their own appointments ──
        $patient = Role::firstOrCreate(['name' => 'patient']);
        $patient->syncPermissions(['view appointments']);

        // Default superadmin account.
        $user = User::firstOrCreate(
            ['email' => 'admin@dermatologist.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'),
            ]
        );

        $user->assignRole('superadmin');
    }
}
