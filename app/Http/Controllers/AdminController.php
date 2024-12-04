<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function Setting(){
        $settings = Setting::first();
        return view('admin.setting',compact('settings'));
    }
    public function settingStore(Request $request){
        $request->validate([
            'app_title' => 'required|string',
            'app_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'login_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }
    
        $settings->app_title = $request->app_title;
    $settings->footer_title = $request->footer_text;
        if ($request->hasFile('app_logo')) {
            $settings->app_logo = $request->file('app_logo')->store('public/logos');
        }
    
        if ($request->hasFile('login_logo')) {
            $settings->login_logo = $request->file('login_logo')->store('public/logos');
        }
    
        if ($request->hasFile('favicon_logo')) {
            $settings->favicon_logo = $request->file('favicon_logo')->store('public/logos');
        }
    
        $settings->save();
    
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    public function editProfile(){
        return view('admin.editprofile');
    }
    public function updateProfile(Request $request) {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Get the current user
        $user = auth()->user();
    
        // Update name and email
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
    
        // Handle profile image upload
       // Handle profile image upload
       if ($request->hasFile('profile_image')) {
        // Delete the old profile image if exists
        if ($user->image) {
            Storage::delete('public/profile/profile_images/' . $user->image);
        }
    
        $image = $request->file('profile_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/profile/profile_images', $imageName);
        $user->image = $imageName;
    }
    
        // Save the updated user
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function changePassword(){
        return view('admin.change_password');
    }
    public function passwordStore(Request $request){
        $user = Auth::user();
        $currentPassword = $user->password;
        $newPassword = $request->new_password;
        $confirmPassword = $request->new_password_confirmation;
    
        // Validate the input
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($currentPassword) {
                if (!Hash::check($value, $currentPassword)) {
                    return $fail(__('The :attribute is incorrect.'));
                }
            }],
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        // Update the password
        $user->password = Hash::make($newPassword);
        $user->save();
    
        return back()->with('success', 'Password updated successfully!');
    }
    public function show(){

    }
    public function showUserRequests()
    {
        // Fetch users with a 'pending' status (adjust based on your application's logic)
        $users = User::where('status', 'inactive')->with('branch')->get();

        return view('users.user_request', compact('users'));
    }

    /**
     * Activate a user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activateUser($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
            $branch=Branch::find($user->branch_id);
            if($branch){
                $branch->status='active';
                $branch->save();
            }
            // Activate the user (assuming you have a 'status' column)
            $user->status = 'active'; // Set the status to active
            $user->save();

            // Redirect back with a success message
            return redirect()->route('admin.userRequests')->with('success', 'User activated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.userRequests')->with('error', 'Failed to activate the user. Please try again.');
        }
    }
}
