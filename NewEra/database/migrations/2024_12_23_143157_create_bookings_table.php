<?php

use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     * (No need to define up() and down() methods for MongoDB)
     *
     * @return void
     */
    public function up()
    {
        // MongoDB collections are created automatically when data is inserted
        // This method can be left empty or removed entirely
    }

    /**
     * Reverse the migrations.
     * (Not needed for MongoDB)
     *
     * @return void
     */
    public function down()
    {
        // MongoDB collections are not dropped by default
        // You can omit this method or leave it empty
    }
}
