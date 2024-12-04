<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create the super-admin role
        $superAdminRole = Role::firstOrCreate(['name' => 'system-admin']);

        // Comprehensive permissions list
        $permissions = [

            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
   // Branch Management
            'view branches',
            'create branches',
            'edit branches',
            'delete branches',
            // Role Management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Permission Management
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',

            // Inventory Management
            'view inventory',
            'create inventory',
            'edit inventory',
            'delete inventory',

            // Sales Management
            'view sales',
            'create sales',
            'edit sales',
            'delete sales',

            // Additional Permissions
            'manage settings',
            'view reports',
            'manage notifications',
            'manage system logs',
            // Add any additional permissions as required
        ];

        // Create each permission and assign it to the super-admin role
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $superAdminRole->givePermissionTo($permission);
        }
    }
}
