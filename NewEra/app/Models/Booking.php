<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    // Fields that are mass-assignable
    protected $fillable = [
        'booking_id',     // UTM + Randomized Incremental ID
        'matric_number',  // Authenticated user's matric number
        'date',           // Booking date
        'start_time',     // Start time
        'end_time',       // End time
        'court',          // Selected court
        'payment_status', // Payment status (e.g., 'Paid', 'Pending')
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            // Generate a unique booking ID
            $booking->booking_id = 'UTM' . str_pad((string) random_int(10000, 99999), 5, '0', STR_PAD_LEFT);
        });
    }

}
