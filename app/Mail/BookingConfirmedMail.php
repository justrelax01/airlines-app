<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Booking $booking,
        public string $ref
    ) {}

    public function build(): self
    {
        return $this->subject("Booking Confirmed — {$this->ref}")
                    ->view('emails.booking-confirmed');
    }
}
