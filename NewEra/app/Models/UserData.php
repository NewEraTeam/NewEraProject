<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserData extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'user_data';
    protected $fillable = ['name', 'email'];
}
