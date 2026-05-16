<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
    $table->id();
    $table->string('flight_number');
    $table->string('origin');
    $table->string('destination');
    $table->dateTime('departure_time');
    $table->dateTime('arrival_time');
    $table->integer('available_seats');
    $table->decimal('price', 8, 2);
    $table->enum('status', ['scheduled', 'cancelled', 'delayed', 'completed'])->default('scheduled');
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
        Schema::dropIfExists('flights');
    }
}
