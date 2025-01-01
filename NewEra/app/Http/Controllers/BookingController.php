<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\Support\Facades\DB; // Add this at the top of your controller
use Stripe\Stripe;
use Stripe\Checkout\Session;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        // Validate the incoming request
        try {
            $validated = $request->validate([
                'matric_number' => 'required|string',
                'date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'court' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

            $booking = Booking::create([
                'booking_id' => 'UTM52612',
                'matric_number' => $validated['matric_number'],
                'date' => $validated['date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'court' => $validated['court'],
                'payment_status' => 'Pending', // Default payment status
            ]);

            //dd('DONE');

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Prepare product and price details for Stripe
        $productname = $validated['court'];
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
            'success_url' => route('success', ['booking_id' => $booking->id]),
            'cancel_url' => route('checkout'),
        ]);

        return redirect($session->url); // Redirect to Stripe checkout
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function success(Request $request)
    {
        $bookingId = $request->get('booking_id');

        // Update the payment status to "Success"
        $booking = Booking::find($bookingId);
        if ($booking) {
            $booking->update(['payment_status' => 'Success']);
        }

        return view('BookingModule.BookingSuccess', ['booking' => $booking]);
    }
    /**
     * Show the booking badminton page.
     */
    public function showBadmintonBooking()
    {
        return view('BookingModule.bookingBadminton');
    }

    public function showBookingBadminton()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed.');
        }

        // Pass necessary booking data to the view
        return view('BookingModule.bookingBadminton', [
            'total_price' => 50.00 // Example total price; replace this with your logic
        ]);
    }

}
