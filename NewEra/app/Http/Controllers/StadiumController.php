<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StadiumController extends Controller
{
    public function index()
    {
        return view('FacilityModules.stadium'); // Points to 'css/views/FacilityModules/stadium.blade.php'
    }
}
