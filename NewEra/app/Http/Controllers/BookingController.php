<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Show the booking badminton page.
     */
    public function showBookingBadminton()
    {
        return view('BookingModule.bookingBadminton'); // Matches your view path
    }

    /**
     * Handle the submission of booking details (Badminton).
     */
    public function submitBookingBadminton(Request $request)
    {

        dd($request->all()); // Check the incoming data

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
        $booking->phone = $validated['phone'];
        $booking->save();

        // Redirect to the payment page
        return redirect()->route('bookingPayment');
    }

    /**
     * Show the payment page.
     */
    public function showPayment()
    {
        return view('BookingModule.BookingPayment'); // Matches your view path
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

        // Mark the booking as completed
        $booking->status = 'completed'; // Assuming a status column exists in the database
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
}
