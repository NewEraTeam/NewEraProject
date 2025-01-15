<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;

class AdminBookingController extends Controller
{
    public function showBookings()
    {
        try {
            // Establish MongoDB connection
            $client = new Client(env('DB_CONNECTION_STRING')); // Ensure the connection string is correctly set in your .env file

            // Select the database
            $db = $client->selectDatabase('NewEra'); // Replace 'NewEra' with your actual database name if different

            // Fetch data from collections
            $bookings = $db->bookings->find()->toArray();
            $gymBooks = $db->gym_books->find()->toArray();
            $stadiumBooks = $db->stadium_books->find()->toArray();
            $swimmingBooks = $db->swimming_books->find()->toArray();

            // Combine all bookings into one array
            $allBookings = array_merge($bookings, $gymBooks, $stadiumBooks, $swimmingBooks);

            // Pass data to the Blade view
            return view('admin.bookings', ['bookings' => $allBookings]);

        } catch (\Exception $e) {
            // Handle errors gracefully and provide feedback
            return back()->withErrors(['error' => 'Failed to fetch bookings: ' . $e->getMessage()]);
        }
    }
}
