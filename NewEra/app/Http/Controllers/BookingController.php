<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Show the booking badminton page.
     */

     public function showBadmintonBooking()
{
    return view('booking.bookingBadminton');
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
     * Handle the submission of booking details (Badminton).
     */
    public function submitBookingBadminton(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|numeric|between:8,19', // Start time validation
            'end_time' => 'required|numeric|between:9,20|gt:start_time', // End time must be greater than start time
            'court' => 'required|string|max:50',
        ]);

        // Save the data to the database
        $booking = new Booking();
        $booking->date = $validated['date'];
        $booking->start_time = $validated['start_time'];
        $booking->end_time = $validated['end_time'];
        $booking->court = $validated['court'];
        $booking->status = 'pending'; // Set default status
        $booking->user_id = Auth::id(); // Associate the booking with the authenticated user
        $booking->save();

        // Save the booking ID in the session for reference
        $request->session()->put('booking_id', $booking->id);

        // Redirect to the personal details page
        return redirect()->route('bookingPersonalDetails');
    }

    /**
     * Show the personal details page.
     */
    public function showPersonalDetails()
    {
        return view('BookingModule.BookingPersonalDetails'); // Matches your view path
    }

    /**
     * Handle the submission of personal details.
     */
    public function submitPersonalDetails(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'matric_number' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);

        // Retrieve the booking ID from the session
        $bookingId = $request->session()->get('booking_id');

        // Find the booking by ID
        $booking = Booking::find($bookingId);
        if (!$booking) {
            return redirect()->route('bookingBadminton')->with('error', 'Booking not found.');
        }

        // Update the booking with personal details
        $booking->name = $validated['name'];
        $booking->matric_number = $validated['matric_number'];
        $booking->email = $validated['email'];
        $booking->phone_number = $validated['phone']; // Ensure this matches the column in your database
        $booking->save();

        // Redirect to the payment page
        return redirect()->route('bookingPayment');
    }

    /**
     * Show the payment page.
     */
    public function showPayment(Request $request)
    {
        // Retrieve the booking ID from the session
        $bookingId = $request->session()->get('booking_id');
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return redirect()->route('bookingBadminton')->with('error', 'Booking not found.');
        }

        // Pass the booking details to the payment page
        return view('BookingModule.BookingPayment', ['booking' => $booking]);
    }

    /**
     * Handle the booking payment process.
     */public function submitPayment(Request $request)
{
    // Validate the input
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required|integer',
        'end_time' => 'required|integer|gt:start_time',
        'court' => 'required|array',
        'payment_method_id' => 'required|string',
    ]);

    // Calculate total price
    $duration = $request->end_time - $request->start_time;
    $totalPrice = count($request->court) * $duration * 5.0; // RM5 per court per hour

    // Save Booking Data
    $booking = Booking::create([

        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'courts' => $request->court,
        'total_price' => $totalPrice,
    ]);

    // Now process the payment using Stripe
    try {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $totalPrice * 100, // Convert RM to cents
            'currency' => 'myr',
            'payment_method' => $request->payment_method_id,
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);

        // Return success response
        return redirect()->back()->with('success', 'Payment successful! Your booking is confirmed.');
    } catch (\Exception $e) {
        // If payment fails, you might want to delete the booking
        $booking->delete();

        return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
    }
}

    /**
     * Show the booking success page.
     */
    public function showSuccess()
    {
        return view('BookingModule.BookingSuccess'); // Matches your view path
    }

    /**
     * Retrieve all bookings for the authenticated user.
     */
    public function myBookings()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();

        return view('BookingModule.MyBookings', [
            'bookings' => $bookings
        ]);
    }

}
