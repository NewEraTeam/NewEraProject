<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique(); // Custom BookingID
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('court'); // Can store court names (e.g., "Court 1")
            $table->string('payment_status')->default('Pending'); // Payment Status: Pending/Completed
            $table->timestamps(); // Auto-generated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
