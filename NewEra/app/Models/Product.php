<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
}
