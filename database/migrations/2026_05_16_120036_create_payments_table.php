<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
    $table->enum('method', ['credit_card', 'cash']);
    $table->decimal('amount', 8, 2);
    // Credit card fields (nullable for cash)
    $table->string('card_last_four')->nullable();
    $table->string('cardholder_name')->nullable();
    // Cash fields
    $table->date('cash_due_date')->nullable();
    $table->enum('payment_status', ['pending', 'completed', 'failed', 'expired'])->default('pending');
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
        Schema::dropIfExists('payments');
    }
}
