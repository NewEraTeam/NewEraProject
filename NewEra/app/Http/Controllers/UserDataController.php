<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDataController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Fetch the user by username
        $user = UserData::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Login the user using session
            Auth::login($user);

            // Redirect to the main page after login
            return redirect()->route('MainPage.page');  // Ensure this route exists in routes/web.php
        }

        // If login fails, redirect back with error message
        return back()->withErrors(['login' => 'Invalid username or password.']);
    }

    public function showForm()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        UserData::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('form.page')->with('success', 'User data saved successfully!');
    }

    public function showSearch()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $users = UserData::where('name', 'like', '%' . $request->name . '%')->get();

        return view('search', compact('users'));
    }
}
