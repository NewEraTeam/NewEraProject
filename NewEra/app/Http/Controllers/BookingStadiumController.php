<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StadiumBooks;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

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
                'add_on' => 'required|array', // Ensure `add_on` is an array
                'add_on.*' => 'string',      // Each `add_on` value must be a string
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
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
        ]);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Prepare product and price details for Stripe
        $productname = 'STADIUM BOOK';
        $totalprice = $request->get('total_price');
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
