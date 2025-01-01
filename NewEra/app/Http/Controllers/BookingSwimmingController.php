<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class BookingSwimmingController extends Controller
{
    public function showSwimmingBooking()
    {
        return view('BookingModule.bookingSwimming');
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        try {
            $validated = $request->validate([
                'matric_number' => 'required|string',
                'date' => 'required|date',
                'session' => 'required|string',
                'rent_swimming_cap' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

            $booking = Booking::create([
                'booking_id' => 'UTM52612',
                'matric_number' => $validated['matric_number'],
                'date' => $validated['date'],
                'session' => $validated['session'],
                'rent_swimming_cap' => $validated['rent_swimming_cap'],
                'payment_status' => 'Pending', // Default payment status
            ]);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Prepare product and price details for Stripe
        $productname = $validated['session'];
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

    public function showBookingSwimming()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed.');
        }

        // Pass necessary booking data to the view
        return view('BookingModule.bookingSwimming', [
            'total_price' => 50.00 // Example total price; replace this with your logic
        ]);
    }
}
