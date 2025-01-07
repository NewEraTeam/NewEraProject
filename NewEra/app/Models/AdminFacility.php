<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminFacility extends Model
{
    use HasFactory;

    // Specify the table if it does not match the plural of the model name
    protected $table = 'admin_facility';

    // Fillable attributes
    protected $fillable = ['venue', 'reason', 'date'];
}
