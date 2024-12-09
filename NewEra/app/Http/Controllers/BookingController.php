<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Assuming there is a Booking model to handle database interaction

class BookingController extends Controller
{
    /**
     * Show the booking badminton page.
     */
    public function showBookingBadminton()
    {
        return view('bookingBadminton');
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

        // Save the data to the session or database
        $booking = new Booking();
        $booking->date = $validated['date'];
        $booking->time = $validated['time'];
        $booking->court = $validated['court'];
        $booking->save();

        // Save the booking ID in the session for later reference
        $request->session()->put('booking_id', $booking->id);

        // Redirect to the next page
        return redirect()->route('booking.personalDetails');
    }

    /**
     * Show the personal details page.
     */
    public function showPersonalDetails()
    {
        return view('BookingPersonalDetails');
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

        // Update the booking with personal details
        $booking = Booking::find($bookingId);
        if (!$booking) {
            return redirect()->route('booking.badminton')->with('error', 'Booking not found.');
        }

        $booking->name = $validated['name'];
        $booking->matric_number = $validated['matric_number'];
        $booking->email = $validated['email'];
        $booking->phone = $validated['phone'];
        $booking->save();

        // Redirect to the payment page
        return redirect()->route('booking.payment');
    }

    /**
     * Show the payment page.
     */
    public function showPayment()
    {
        return view('BookingPayment');
    }

    /**
     * Handle the booking payment process.
     */
    public function submitPayment(Request $request)
    {
        // Add payment logic here
        // For now, just display a success message

        return redirect()->route('booking.success')->with('success', 'Booking completed successfully!');
    }

    /**
     * Show the booking success page.
     */
    public function showSuccess()
    {
        return view('BookingSuccess'); // Create a success page view
    }
}
