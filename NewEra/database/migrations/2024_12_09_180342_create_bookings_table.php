<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Specify the table if it doesn't match the model name
    protected $table = 'bookings';

    // Specify the fillable attributes
    protected $fillable = [
        'date',
        'time',
        'court',
        'name',
        'matric_number',
        'email',
        'phone',
        'status',
    ];
}
