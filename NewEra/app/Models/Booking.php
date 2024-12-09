<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Booking extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'bookings';

    protected $fillable = [
        'facility_details',
        'personal_details',
        'payment_details',
    ];
}
