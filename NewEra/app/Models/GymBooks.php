<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymBooks extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';  // Ensure the model is using the MongoDB connection

    protected $fillable = [
        'facilityID_gym',
        'booking_id',
        'matric_number',
        'booking_type',
        'start_date',
        'end_date',
        'start_month',
        'end_month',
        'payment_status',
        'total_price',
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
