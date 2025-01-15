<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StadiumBooks;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use MongoDB\Client as MongoClient;



class BookingStadiumController extends Controller
{
    public function showStadiumBooking()
    {
        return view('BookingModule.bookingStadium');
    }


    public function storeStadium(Request $request)
    {
        // Validate the incoming request
        try {
            $validated = $request->validate([
                'matric_number' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'add_on' => 'nullable|array', // Ensure `add_on` is an array
                'add_on.*' => 'string',      // Each `add_on` value must be a string
                'total_price' => 'required|numeric|min:0', // Add validation for total_price
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

    // MongoDB connection
    $client = new MongoClient(env('DB_CONNECTION_STRING'));
    $adminDB = $client->selectDatabase('admin_facilities');
    $stadiumDB = $client->selectDatabase('stadium_books');

    $startDate = $validated['start_date'];
    $endDate = $validated['end_date'];
    $facilityID = 'UTM_ST';

    // Check admin_manage_facility for blocked dates
    $adminBlocked = $adminDB->selectCollection('admin_facilities')->findOne([
        'facilityID' => $facilityID,
        '$or' => [
            ['start_date' => ['$lte' => $startDate], 'end_date' => ['$gte' => $startDate]],
            ['start_date' => ['$lte' => $endDate], 'end_date' => ['$gte' => $endDate]],
            ['start_date' => ['$gte' => $startDate], 'end_date' => ['$lte' => $endDate]],
        ],
    ]);

    if ($adminBlocked) {
        $reason = $adminBlocked['reason'] ?? 'Reason not specified';
        return back()->withErrors(['error' => "Booking blocked: $reason"]);
    }

    // Check stadium_books for already booked dates
    $existingBooking = $stadiumDB->selectCollection('stadium_books')->findOne([
        '$or' => [
            ['start_date' => ['$lte' => $startDate], 'end_date' => ['$gte' => $startDate]],
            ['start_date' => ['$lte' => $endDate], 'end_date' => ['$gte' => $endDate]],
            ['start_date' => ['$gte' => $startDate], 'end_date' => ['$lte' => $endDate]],
        ],
    ]);

    if ($existingBooking) {
        return back()->withErrors(['error' => 'Booking already made for the selected dates.']);
    }

        // Create the booking record
        $booking = StadiumBooks::create([
            'facilityID_stadium' => 'UTM_ST',
            'booking_id' => 'UTM52612',
            'matric_number' => $validated['matric_number'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'add_on' => $validated['add_on'], // Save as an array
            'payment_status' => 'Pending',    // Default payment status
            'total_price' => $validated['total_price'], // Add validation for total_price
        ]);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Prepare product and price details for Stripe
        $productname = 'STADIUM BOOK';
        $totalprice = $validated['total_price'];
        //dd($totalprice);
        $total_in_cents = intval($totalprice * 100); // Convert to cents for Stripe

        // Create a Stripe Checkout session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'myr', // Malaysian Ringgit
                        'product_data' => [
                            'name' => $productname,
                        ],
                        'unit_amount' => $total_in_cents, // Stripe requires amount in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('successStadium', ['booking_id' => $booking->id]),
            'cancel_url' => route('checkoutStadium', ['booking_id' => $booking->id]),
        ]);

        return redirect($session->url); // Redirect to Stripe checkout
    }

    public function checkoutStadium(Request $request)
    {
        $bookingId = $request->get('booking_id');

        // Update the payment status to "Success"
        $booking = StadiumBooks::find($bookingId);
        if ($booking) {
            $booking->update(['payment_status' => 'Failed']);
        }

        return view('BookingModule.BookingFail', ['booking' => $booking]);
    }

    public function successStadium(Request $request)
    {
        $bookingId = $request->get('booking_id');

        // Update the payment status to "Success"
        $booking = StadiumBooks::find($bookingId);
        if ($booking) {
            $booking->update(['payment_status' => 'Success']);
        }

        $user = Auth::user();
        if (!$user || !$user->email) {
            throw new \Exception("User email not found.");
        }

        $email = $user->email;

        $emailData = [
            'matric_number' => $booking->matric_number ?? 'N/A',
            'booking_id' => $booking->booking_id ?? 'N/A',
            'total_price' => $booking->total_price ?? 'N/A',
            'payment_status' => $booking->payment_status ?? 'N/A',
        ];

        Log::info('Email data:', context: $emailData);emailData:
        Mail::send('Mailables.BookingConfirmationMail', ['emailData' => $emailData], function ($message) {

            $user = Auth::user();
            if (!$user || !$user->email) {
                throw new \Exception("User email not found.");
            }

            $email = $user->email;

            $message->to($email)
                    ->subject('Booking Confirmation');
        });

        Log::info('Email sent successfully to: ' . $email);

        return view('BookingModule.BookingSuccess', ['booking' => $booking]);
    }

    public function showBookingStadium()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed.');
        }

        // Pass necessary booking data to the view
        return view('BookingModule.bookingStadium', [
            'total_price' => 50.00 // Example total price; replace this with your logic
        ]);
    }
}
