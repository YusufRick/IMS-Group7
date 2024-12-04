<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['branch', 'roles'])
        ->whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['system-admin', 'super-admin']);
        })->where('status','active')
        ->get();
   
    return view('users.index', compact('users'));  
    }

    public function create()
    {
        $branches = Branch::all();
        $roles = Role::all();
        return view('users.create', compact('branches', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|alpha_num|unique:users,username|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'branch_id' => 'nullable|exists:branches,branch_id',
            'role_id' => 'required|exists:roles,name',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = new User($request->except('password', 'role_id', 'image'));
        $user->password = Hash::make($request->password);
    
        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('images/users', 'public');
        }
    
        $user->save();
        $user->assignRole($request->role_id);
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $branches = Branch::all();
        $roles = Role::all();
        return view('users.edit', compact('user', 'branches', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|alpha_num|unique:users,username,' . $user->id . '|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'branch_id' => 'nullable|exists:branches,branch_id',
            'role_id' => 'required|exists:roles,name',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'password.regex' => 'Password must include at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.',
            'username.regex' => 'Username must be alphanumeric without spaces or special characters.'
        ]);
    
        $user->update($request->except('password', 'role_id', 'image'));
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->image = $request->file('image')->store('images/users', 'public');
        }
    
        $user->syncRoles([$request->role_id]);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

