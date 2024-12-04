<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SystemAdminSeeder extends Seeder
{
    public function run()
    {
        // Ensure super-admin role exists
        $superAdminRole = Role::where('name', 'system-admin')->first();

        if (!$superAdminRole) {
            $this->call(RolePermissionSeeder::class);
            $superAdminRole = Role::where('name', 'system-admin')->first();
        }

        // Create system admin user
        $systemAdmin = User::firstOrCreate(
            ['email' => 'systemadmin@example.com'],  // use a unique email
            [
                'username' => 'system_admin',
                'first_name' => 'System',
                'last_name' => 'Admin',
                'password' => Hash::make('InvMngPass!23'), // Ensure password meets requirements
            ]
        );

        // Assign the super-admin role
        $systemAdmin->assignRole($superAdminRole);
    }
}
