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
            'time' => 'required',
            'court' => 'required',
        ]);

        // Save the data to the database
        $booking = new Booking();
        $booking->date = $validated['date'];
        $booking->time = $validated['time'];
        $booking->court = $validated['court'];
        $booking->status = 'pending'; // Set default status
        $booking->user_id = Auth::id(); // Associate the booking with the authenticated user
        $booking->save();

        // Save the booking ID in the session for reference
        $request->session()->put('booking_id', $booking->id);

        // Redirect to the personal details page
        return redirect()->route('bookingPayment');
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
        $booking->phone = $validated['phone'];
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
     */
    public function submitPayment(Request $request)
    {
        // Retrieve the booking ID from the session
        $bookingId = $request->session()->get('booking_id');
        $booking = Booking::find($bookingId);
        if (!$booking) {
            return redirect()->route('bookingBadminton')->with('error', 'Booking not found.');
        }

        // Validate the payment amount if necessary
        $validated = $request->validate([
            'payment_amount' => 'required|numeric|min:1', // Ensure payment amount is provided
        ]);

        // Update the booking status and store payment amount (if applicable)
        $booking->status = 'completed'; // Assuming a status column exists in the database
        $booking->payment_amount = $validated['payment_amount']; // Add this column in your bookings table if not already present
        $booking->save();

        // Clear the session booking ID
        $request->session()->forget('booking_id');

        return redirect()->route('bookingSuccess')->with('success', 'Booking completed successfully!');
    }

    /**
     * Show the booking success page.
     */
    public function showSuccess()
    {
        return view('BookingModule.BookingSuccess'); // Matches your view path
    }

    /**
     * (New) Retrieve all bookings for the authenticated user.
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
