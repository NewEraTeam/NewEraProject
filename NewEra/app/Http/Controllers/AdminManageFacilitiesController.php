<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminFacility;

class AdminManageFacilitiesController extends Controller
{
    /**
     * Store venue data in MongoDB Atlas.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'venue' => 'required|string',
            'reason' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Save data to MongoDB
        AdminFacility::create([
            'venue' => $validated['venue'],
            'reason' => $validated['reason'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        // Return success response
        return back()->with('success', 'Facility data saved successfully!');
    }
}
