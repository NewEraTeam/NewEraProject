<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymBooks;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Log;

class BookingGymController extends Controller
{
    public function showGymBooking()
    {
        return view('BookingModule.bookingGym');
    }


    public function storeGym(Request $request)
    {
        // Validate the incoming request
        try {
            $validated = $request->validate([
                'matric_number' => 'required|string',
                'email' => 'required|email', // Ensure email exists in the database
                'booking_type' => 'required|string|in:daily,membership',
                'start_date' => 'nullable|date|required_if:booking_type,daily',
                'end_date' => 'nullable|date|required_if:booking_type,daily',
                'start_month' => 'nullable|string|required_if:booking_type,membership',
                'end_month' => 'nullable|string|required_if:booking_type,membership',
                'total_price' => 'required|numeric|min:0', // Add validation for total_price
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }
        // dd($validated['email']);

        $data = [
            'facilityID_gym' => 'UTM_GM',
            'booking_id' => 'UTM52612',
            'matric_number' => $validated['matric_number'],
            'booking_type' => $validated['booking_type'],
            'payment_status' => 'Pending', // Default payment status
            'total_price' => $validated['total_price'], // Add validation for total_price
        ];

        // Add daily booking details
        if ($validated['booking_type'] === 'daily') {
            $data['start_date'] = $validated['start_date'];
            $data['end_date'] = $validated['end_date'];
        }

        // Add membership booking details
        if ($validated['booking_type'] === 'membership') {
            $data['start_month'] = $validated['start_month'];
            $data['end_month'] = $validated['end_month'];
        }

        $booking = GymBooks::create($data);

        // Set up Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Prepare product and price details for Stripe
        $productname = $validated['booking_type'];
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
            'success_url' => route('successGym', ['booking_id' => $booking->id]),
            'cancel_url' => route('checkoutGym', ['booking_id' => $booking->id]),
        ]);

        return redirect($session->url); // Redirect to Stripe checkout
    }

    public function checkoutGym(Request $request)
    {
        $bookingId = $request->get('booking_id');

        // Update the payment status to "Success"
        $booking = GymBooks::find($bookingId);
        if ($booking) {
            $booking->update(['payment_status' => 'Failed']);
        }

        return view('BookingModule.BookingFail', ['booking' => $booking]);
    }

    public function successGym(Request $request)
    {
        try {
            $bookingId = $request->get('booking_id');
            $booking = GymBooks::find($bookingId);

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

            Log::info('Email data:', context: $emailData);
            Mail::to($email)->send(new BookingConfirmationMail($emailData));


            Log::info('Email sent successfully to: ' . $email);
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }
        return view('BookingModule.BookingSuccess', ['booking' => $booking]);
    }



    public function showBookingGym()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed.');
        }

        // Pass necessary booking data to the view
        return view('BookingModule.bookingGym', [
            'total_price' => 50.00 // Example total price; replace this with your logic
        ]);
    }
}
