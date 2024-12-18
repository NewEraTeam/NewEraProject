<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserData; // MongoDB Model

class AdminController extends Controller
{
    // Handle login for both normal users and admin (Staff)
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if both username and password are 'admin123'
        if ($request->username === 'admin123' && $request->password === 'admin123') {
            // Fetch the admin user from MongoDB (admin123 user)
            $adminUser = UserData::where('username', 'admin123')->first();

            // Check if the admin user exists
            if ($adminUser) {
                // Log the admin in manually
                Auth::loginUsingId($adminUser->_id);

                // Redirect to AdminMain page
                return redirect()->route('admin.main')->with('success', 'Welcome, Admin!');
            }
        }

        // If credentials don't match 'admin123', check MongoDB for regular user
        $user = UserData::where('username', $request->username)->first();

        // Verify user password for regular user
        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            // Regular user login
            Auth::loginUsingId($user->_id);

            // Redirect to user home page or dashboard
            return redirect()->route('home')->with('success', 'Welcome, User!');
        }

        // If credentials fail
        return back()->withErrors(['username' => 'Invalid username or password.'])->onlyInput('username');
    }

    // Show the AdminMain page (only for admin)
    public function showMainPage()
    {
        return view('AdminModule.AdminMainPageModule.AdminMain');
    }

    // Logout staff/admin
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.page')->with('success', 'You have been logged out.');
    }
}
