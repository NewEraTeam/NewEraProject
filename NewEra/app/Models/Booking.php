<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'date',
        'start_time',
        'end_time',
        'court',
        'payment_status',
    ];

    // Automatically generate BookingID
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = self::latest('id')->first();
            $nextId = $latest ? $latest->id + 1 : 1;
            $model->booking_id = 'UTM' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
        });
    }
}
