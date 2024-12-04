<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadmintonController extends Controller
{
    public function index()
    {
        return view('FacilityModules.badminton');
    }
}
