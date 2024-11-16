<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GymController extends Controller
{
    public function index()
    {
        return view('FacilityModules.gym'); // Points to 'css/views/FacilityModules/gym.blade.php'
    }
}
