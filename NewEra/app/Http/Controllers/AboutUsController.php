<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    // Method to return the About Us view
    public function index()
    {
        return view('AboutUsModule.AboutUs'); // Correct path to your view file
    }
}
