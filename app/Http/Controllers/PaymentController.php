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
  public function index(Request $request)
{
    $booking = Booking::where('user_id', auth()->id())
                      ->whereIn('status', ['pending', 'confirmed'])
                      ->with('flight')
                      ->first();

    $flight     = $request->has('flightId') ? \App\Models\Flight::find($request->flightId) : null;
    $passengers = $request->get('passengers', 1);

    return view('pages.payment', compact('booking', 'flight', 'passengers'));
}

    public function store(Request $request)
    {
        
        $alreadyBooked = Booking::where('user_id', auth()->id())
                                ->whereIn('status', ['pending', 'confirmed'])
                                ->exists();

        if ($alreadyBooked) {
            return redirect()->back()->withErrors([
                'booking' => 'You already have an active booking. Each user is limited to one reservation.'
            ]);
        }

        
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
            return redirect()->back()->withErrors([
                'booking' => 'Not enough available seats.'
            ]);
        }

        // 4. Create booking 
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

        //  5. Create payment 
        $payment = Payment::create([
            'booking_id'      => $booking->id,
            'method'          => $validated['method'],
            'amount'          => $total,
            'card_last_four'  => $validated['card_last_four'] ?? null,
            'cardholder_name' => $validated['cardholder_name'] ?? null,
            'cash_due_date'   => $validated['cash_due_date'] ?? null,
            'payment_status'  => $validated['method'] === 'credit_card' ? 'completed' : 'pending',
        ]);

        //  6. Confirm and send email if credit card 
        $ref = 'BK-' . strtoupper(Str::random(8));

        if ($validated['method'] === 'credit_card') {
            $booking->update(['status' => 'confirmed']);
            $booking->load('user', 'flight');
            if ($booking->user && $booking->user->email) {
                Mail::to($booking->user->email)
                    ->send(new BookingConfirmedMail($booking, $ref));
            }
        }

        //  7. Redirect back to payment page with booking 
        return redirect()->route('payment.index');
    }

   public function destroy($id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->user_id !== auth()->id()) {
        abort(403);
    }

    $booking->flight->increment('available_seats', $booking->seats_booked);
    $booking->delete();

    return redirect()->route('payment.index');
}
}