<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
           $table->id();
$table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
$table->string('full_name');
$table->string('email');
$table->string('phone');
$table->integer('age');
$table->string('country');
$table->string('city');
$table->enum('room_type', ['single', 'double', 'suite']);
$table->date('return_date');
$table->time('return_time');
$table->text('message')->nullable();
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_bookings');
    }
}
