<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToTables extends Migration
{
    public function up()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->index('status');
            $table->index('departure_time');
            $table->index('origin');
            $table->index('destination');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('flight_id');
            $table->index('status');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->index('booking_id');
            $table->index('payment_status');
        });

        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['departure_time']);
            $table->dropIndex(['origin']);
            $table->dropIndex(['destination']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['flight_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['booking_id']);
            $table->dropIndex(['payment_status']);
        });

        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });
    }
}
