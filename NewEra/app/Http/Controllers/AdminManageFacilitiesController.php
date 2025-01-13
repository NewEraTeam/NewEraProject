<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Client as MongoDB;
use App\Models\AdminFacility;

class AdminManageFacilitiesController extends Controller
{
    private $mongoDb;

    public function __construct()
    {
        // Establish a MongoDB connection
        $this->mongoDb = (new MongoDB())->NewEra;
    }

    public function closeVenue(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'venue' => 'required|string',
            'reason' => 'required|string',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        $venue = $request->input('venue');
        $reason = $request->input('reason');
        $date = $request->input('date');

        $collections = [
            'swimming_books' => 'facilityID_swimming',
            'gym_books' => 'facilityID_gym',
            'stadium_books' => 'facilityID_stadium',
            'bookings' => 'facilityID_badminton'
        ];

        foreach ($collections as $collectionName => $facilityID) {
            $collection = $this->mongoDb->$collectionName;

            $existingBooking = $collection->findOne([
                $facilityID => $venue,
                'date' => $date
            ]);

            if ($existingBooking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, the date is blocked for ' . $reason,
                ]);
            }
        }

        // Insert the new blocked date into the admin_facility collection
        $this->mongoDb->admin_facility->insertOne([
            'venue' => $venue,
            'reason' => $reason,
            'date' => $date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Venue closed successfully!',
        ]);
    }
}