<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    // This method will return the view for the main page
    public function index()
    {
        return view('mainpage'); // Return the 'mainpage' view
    }
}
