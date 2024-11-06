<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class UserData extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'user_data';
    protected $fillable = ['name', 'email', 'matric_number', 'phone_number', 'role'];
}
