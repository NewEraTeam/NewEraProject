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

        echo $request;

    }

    //Redirect from register to login
    public function showLoginForm()
    {
        return view('login');
    }

    //From login to Main Page
    public function showMainPage(Request $requestMainPage)
    {
        //Validate user information
        $requestMainPage->validate([
            'name' => 'required|string|max:255', //name from register or login
            'email' => 'required|email|unique:user_data,email', //email from register or login
        ]);

        return view('MainPageModule.MainPage');
    }

    public function showAdminMainPage()
    {
        return view('AdminModule.AdminMain');
    }
    


}
