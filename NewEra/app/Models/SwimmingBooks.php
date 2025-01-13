<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwimmingBooks extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';  // Ensure the model is using the MongoDB connection

    protected $fillable = [
        'facilityID_swimming',
        'booking_id',
        'matric_number',
        'date',
        'session',
        'rent_swimming_cap',
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
