<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'manage articles',
            'manage reviews',
            'manage diseases',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'superadmin']);
        $superAdmin->syncPermissions(Permission::all());

        // Create superadmin user
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
