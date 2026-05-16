<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_id', 'method', 'amount',
        'card_last_four', 'cardholder_name',
        'cash_due_date', 'payment_status',
    ];

    protected $casts = [
        'amount'        => 'decimal:2',
        'cash_due_date' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
