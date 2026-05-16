<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmedMail;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_id'       => 'required|exists:flights,id',
            'seats_booked'    => 'required|integer|min:1',
            'method'          => 'required|in:credit_card,cash',
            'card_last_four'  => 'nullable|digits:4|required_if:method,credit_card',
            'cardholder_name' => 'nullable|string|max:255|required_if:method,credit_card',
            'cash_due_date'   => 'nullable|date|required_if:method,cash',
        ]);

        $flight = Flight::findOrFail($validated['flight_id']);

        if ($flight->available_seats < $validated['seats_booked']) {
            return response()->json(['error' => 'Not enough available seats.'], 422);
        }

        $subtotal = $flight->price * $validated['seats_booked'];
        $total    = round($subtotal * 1.15, 2);

        $booking = Booking::create([
            'user_id'      => auth()->id(),
            'flight_id'    => $flight->id,
            'seats_booked' => $validated['seats_booked'],
            'total_price'  => $total,
            'status'       => 'pending',
        ]);

        $flight->decrement('available_seats', $validated['seats_booked']);

        $payment = Payment::create([
            'booking_id'      => $booking->id,
            'method'          => $validated['method'],
            'amount'          => $total,
            'card_last_four'  => $validated['card_last_four'] ?? null,
            'cardholder_name' => $validated['cardholder_name'] ?? null,
            'cash_due_date'   => $validated['cash_due_date'] ?? null,
            'payment_status'  => $validated['method'] === 'credit_card' ? 'completed' : 'pending',
        ]);

        if ($validated['method'] === 'credit_card') {
            $booking->update(['status' => 'confirmed']);
            $booking->load('user', 'flight');
            if ($booking->user?->email) {
                Mail::to($booking->user->email)
                    ->send(new BookingConfirmedMail($booking, $ref));
            }
        }

        $ref = 'BK-' . strtoupper(Str::random(8));

        return response()->json([
            'success'    => true,
            'ref'        => $ref,
            'booking_id' => $booking->id,
            'payment_id' => $payment->id,
        ]);
    }
}
