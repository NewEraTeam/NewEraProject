<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumBooks extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';  // Ensure the model is using the MongoDB connection

    protected $fillable = [
        'facilityID_stadium',
        'booking_id',
        'matric_number',
        'start_date',
        'end_date',
        'add-on',
        'payment_status',
    ];
    protected $casts = [
        'add_on' => 'array',
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
