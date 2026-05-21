<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Declare the properties explicitly up here
    public $booking;
    public $ref;

    // 2. Assign them normally in the constructor
    public function __construct(Booking $booking, string $ref)
    {
        $this->booking = $booking;
        $this->ref = $ref;
    }

    public function build(): self
    {
        return $this->subject("Booking Confirmed — {$this->ref}")
                    ->view('emails.booking-confirmed');
    }
}