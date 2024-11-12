<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent; // Import the new MongoDB model

class UserData extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'user_data';
    protected $fillable = ['name', 'email', 'matric_number', 'phone_number', 'role'];
}
