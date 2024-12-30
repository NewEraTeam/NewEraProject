<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';  // Ensure the model is using the MongoDB connection

    protected $fillable = [
        'booking_id',
        'matric_number',
        'date',
        'start_time',
        'end_time',
        'court',
        'payment_status',
    ];

    // Automatically generate BookingID
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->booking_id = 'UTM' . strtoupper(uniqid());
        });
    }
}
