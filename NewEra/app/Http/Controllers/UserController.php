<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData; // Assuming the UserData model is set up for MongoDB

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_data,email', // email field in MongoDB
            'matric_number' => 'required|string|max:50',
            'phone_number' => 'required|string|max:15',
            'role' => 'required|in:Student,Staff',
        ]);

        // Save to MongoDB
        UserData::create($request->all());

        // Redirect back to login page with success message
        return redirect()->route('login.page')->with('success', 'Registration successful! You may now log in.');
    }
}
