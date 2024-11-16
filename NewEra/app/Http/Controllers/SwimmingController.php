<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwimmingController extends Controller
{
    public function index()
    {
        return view('FacilityModules.swimming'); // Points to 'css/views/FacilityModules/swimming.blade.php'
    }
}
