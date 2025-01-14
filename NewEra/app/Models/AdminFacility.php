<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminFacility extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';  // Ensure the model is using the MongoDB connection

    // Fillable attributes
    protected $fillable = ['venue', 'reason', 'start_date', 'end_date'];
}
