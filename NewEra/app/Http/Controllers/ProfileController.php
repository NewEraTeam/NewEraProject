<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
{
    $user = Auth::user(); // Get the authenticated user

    return view('ProfileModule.profile', compact('user')); // Return the profile view with user data
}
}
