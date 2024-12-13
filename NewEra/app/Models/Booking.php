<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $connection = 'mongodb'; // Use the MongoDB connection
    protected $collection = 'bookings'; // MongoDB collection name

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'court',
        'name',
        'email',
        'matric_number',
        'phone_number',
        'role',
        'total_price',
        'date_booked',
    ];
}
