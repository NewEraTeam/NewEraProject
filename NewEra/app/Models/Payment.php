<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default
    protected $table = 'payments'; // Replace 'payments' with your actual table name
    protected $primaryKey = 'payment_id'; // Replace 'payment_id' with your actual primary key column name
    public $incrementing = false;
    protected $keyType = 'string'; // If the primary key is a string
}
