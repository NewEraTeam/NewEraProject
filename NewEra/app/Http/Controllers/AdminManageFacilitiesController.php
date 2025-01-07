<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminFacility;

class AdminManageFacilitiesController extends Controller
{
    public function AdminFacility(Request $request)
    {
        $request->validate([
            'venue' => 'required',
            'reason' => 'required',
            'date' => 'required|date',
        ]);

        AdminFacility::create($request->only(['venue', 'reason', 'date'])); 

        return response()->json([
            'success' => true,
            'message' => 'Venue closed successfully!',
        ]);
    }
}

