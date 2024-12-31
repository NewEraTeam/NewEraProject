<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\Support\Facades\DB; // Add this at the top of your controller

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

        dd('DONE SUBMIT TO DATABASE');

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = $request->get('courts');
        $totalprice = $request->get('total-price');
        $two0 = "00";
        $total = "$totalprice$two0";

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'MYR',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);


        return redirect()->back()->with('success', 'Booking successfully created! Your Booking ID: ' . $booking->booking_id);
    }

    public function checkout()
    {
        return view('checkout');
    }


    public function success()
    {
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
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

    /**
     * Show the booking success page.
     */
    public function showSuccess()
    {
        return view('BookingModule.BookingSuccess'); // Matches your view path
    }

}
