<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    // Display the form page
    public function showForm()
    {
        return view('form');
    }

    // Store user data in MongoDB
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

    // Display the search page
    public function showSearch()
    {
        return view('search');
    }

    // Search for user by name
    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $users = UserData::where('name', 'like', '%' . $request->name . '%')->get();

        return view('search', compact('users'));
    }

    public function showLogin()
{
    return view('login');
}

// Placeholder for login logic (not fully implemented here)
public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string'
    ]);

    // Here you can add authentication logic
    return redirect()->route('search.page'); // Redirecting to search as a placeholder
}
}
