<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Eloquent
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb'; // Specify MongoDB connection

    protected $fillable = [
        'name',
        'email',
        'password',
        'matric_number',
        'phone_number',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
