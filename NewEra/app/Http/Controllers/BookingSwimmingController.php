<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SwimmingBooks;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Log;

class BookingSwimmingController extends Controller
{
    public function showSwimmingBooking()
    {
        return view('BookingModule.bookingSwimming');
    }


    public function storeSwimming(Request $request)
    {
        // Validate the incoming request
        try {
            $validated = $request->validate([
                'matric_number' => 'required|string',
                'date' => 'required|date',
                'session' => 'required|string',
                'rent_swimming_cap' => 'required|string',
                'total_price' => 'required|numeric|min:0', // Add validation for total_price
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

            $booking = SwimmingBooks::create([
                'facilityID_swimming' => 'UTM_SW',
                'booking_id' => 'UTM52612',
                'matric_number' => $validated['matric_number'],
                'date' => $validated['date'],
                'session' => $validated['session'],
                'rent_swimming_cap' => $validated['rent_swimming_cap'],
                'payment_status' => 'Pending', // Default payment status
                'total_price' => $validated['total_price'], // Add validation for total_price
            ]);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Prepare product and price details for Stripe
        $productname = $validated['session'];
        $totalprice = $validated['total_price'];
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
            'success_url' => route('successSwimming', ['booking_id' => $booking->id]),
            'cancel_url' => route('checkoutSwimming', ['booking_id' => $booking->id]),
        ]);

        return redirect($session->url); // Redirect to Stripe checkout
    }


    public function checkoutSwimming(Request $request)
    {
        $bookingId = $request->get('booking_id');

        // Update the payment status to "Success"
        $booking = Swimmingbooks::find($bookingId);
        if ($booking) {
            $booking->update(['payment_status' => 'Failed']);
        }

        return view('BookingModule.BookingFail', ['booking' => $booking]);
    }

    public function successSwimming(Request $request)
    {

            $bookingId = $request->get('booking_id');
            $booking = SwimmingBooks::find($bookingId);

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
