<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent; // Use MongoDB Eloquent model
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extend Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb'; // Specify MongoDB connection

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
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
