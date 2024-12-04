<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function registerCustomer(){
   
        return view('customer_register');
    }
    public function register(Request $request)
    {
        // Validate the request data for User and Branch
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:19',
            'subscription_type' => 'required|in:standard,premium,advance',
            'company_name' => 'required|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:19',
        ]);
        // Create a new Branch record
        $branch = Branch::create([
            'branch_name' => $request->company_name,
            'location' => $request->company_location,
            'contact_number' => $request->company_phone,
            'status' => 'inactive', // Default branch status to inactive
        ]);

        // Create a new User record with associated Branch
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'subscription_type' => $request->subscription_type,
            'branch_id' => $branch->branch_id,
            'status' => 'inactive', // Default user status to active
            'role_type' => 'customer', // You can set the role type or change as needed
        ]);

        // Redirect or return success response
        return redirect()->back()->with('success', 'Registration successful!');
    }
}