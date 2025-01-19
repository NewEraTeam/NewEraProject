<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as MongoClient;

class AdminBadmintonController extends Controller
{
    public function showBadmintonBookings(Request $request)
    {
        // Connect to MongoDB
        $client = new MongoClient(env('mongodb+srv://newera:newera5@newera.u3gj7.mongodb.net/')); // Update with your MongoDB connection string
        $db = $client->selectDatabase('NewEra');
        $collection = $db->selectCollection('bookings');

        // Get filters
        $search = $request->input('search', '');
        $sortOrder = $request->input('sort', 'asc');

        // MongoDB query and sorting
        $filter = $search
            ? ['$or' => [
                ['booking_id' => ['$regex' => $search, '$options' => 'i']],
                ['matric_number' => ['$regex' => $search, '$options' => 'i']],
                ['court' => ['$regex' => $search, '$options' => 'i']],
            ]]
            : [];

        $cursor = $collection->find($filter, [
            'sort' => ['date' => $sortOrder === 'asc' ? 1 : -1],
        ]);

        // Convert cursor to an array
        $bookings = iterator_to_array($cursor);

        return view('AdminModule.AdminManageFacilitiesModule.booked-badminton', compact('bookings', 'search', 'sortOrder'));
    }
}
