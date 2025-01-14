<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as MongoDB;

class ViewProfileController extends Controller
{
    private $mongoDb;

    public function __construct()
    {
        // Establish a MongoDB connection
        $this->mongoDb = (new MongoDB())->NewEra;
    }

    public function showProfile()
    {
        $user = auth()->user(); 

        if (!$user) {
            return redirect()->route('login.page'); 
        }

        // Fetch bookings for the user
        $bookings = $this->mongoDb->bookings
            ->find(['matric_number' => $user->matric_number])
            ->toArray();

        // Pass user and booking data to the view
        return view('ViewProfileModule.ViewProfile', [
            'user' => $user,
            'bookings' => $bookings
        ]);
    }
}