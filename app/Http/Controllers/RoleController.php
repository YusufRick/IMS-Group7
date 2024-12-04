<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create()
    {
        // Define permissions grouped by module
        $permissions = $this->getPermissions();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function index()
    {
        $roles = Role::whereNotIn('name', ['system-admin', 'super-admin'])->get();
        return view('roles.index', compact('roles'));
    }

    public function edit(Role $role)
    {
        $permissions = $this->getPermissions();
        $assignedPermissions = $role->permissions->pluck('name')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'system-admin') {
            return redirect()->route('roles.index')->with('error', 'SYstem Admin role cannot be deleted.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }


    private function getPermissions()
    {
        return [
            'User Management' => [
                'view users',
                'create users',
                'edit users',
                'delete users',
            ],
            'Branch Management' => [
                'view branches',
                'create branches',
                'edit branches',
                'delete branches',
            ],
            'Role Management' => [
                'view roles',
                'create roles',
                'edit roles',
                'delete roles',
            ],
            'Permission Management' => [
                'view permissions',
                'create permissions',
                'edit permissions',
                'delete permissions',
            ],
            'Inventory Management' => [
                'view inventory',
                'create inventory',
                'edit inventory',
                'delete inventory',
            ],
            'Sales Management' => [
                'view sales',
                'create sales',
                'edit sales',
                'delete sales',
            ],
            'Additional Permissions' => [
                'manage settings',
                'view reports',
                'generate invoice',
                'manage notifications',
                'manage system logs',
            ],
        ];
    }
}
