@extends('layouts.app')

@section('title', 'Complete Your Payment')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Sora:wght@400;600;700&display=swap" rel="stylesheet"/>
<style>
 
 :root {
        --bg: #eef2f7;
        --white: #ffffff;
        --card: #ffffff;
        --border: #e2e8f0;
        --text: #1a202c;
        --muted: #718096;
        --accent: #2563eb;
        --accent-light: #eff6ff;
        --accent-hover: #1d4ed8;
        --danger: #dc2626;
        --danger-bg: #fef2f2;
        --radius: 14px;
        --radius-sm: 8px;
        --shadow: 0 2px 16px rgba(0,0,0,0.07);
        --total-color: #2563eb;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
        padding: 40px 20px 60px;
    }

    .page-header { max-width: 1100px; margin: 0 auto 28px; }
    h1.page-title { font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; margin-bottom: 4px; }
    p.page-subtitle { color: var(--muted); font-size: 0.95rem; }

    .layout {
        max-width: 1100px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 28px;
        align-items: start;
    }

</style>
@endsection


@section('content')

<button class="back-btn" onclick="history.back()">← Back</button>

<div class="page-header">
    <h1 class="page-title">Complete Your Payment</h1>
    <p class="page-subtitle">Enter your credit card details to confirm your booking</p>
</div>

{{-- show already-booked or seat error if redirected back with errors --}}
@if ($errors->has('booking'))
    <div style="max-width:1100px;margin:0 auto 20px;">
        <div class="info-banner" style="background:#fef2f2; color:#dc2626;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0;margin-top:1px">
                <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            <div>{{ $errors->first('booking') }}</div>
        </div>
    </div>
@endif

<div class="layout">

    {{-- LEFT: credit card form --}}
    <div class="payment-card">
        <div class="section-title">Credit Card Payment</div>

        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <div class="input-icon-wrap">
                <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" />
                <span class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                    </svg>
                </span>
            </div>
        </div>
        <div id="successmsg2" style="color:red;font-size:0.82rem;"></div>

        <div class="form-group">
            <label for="cardName">Cardholder Name</label>
            <input type="text" id="cardName" placeholder="John Doe" />
        </div>
        <div id="successmsg3" style="color:red;font-size:0.82rem;"></div>

        <div class="form-row">
            <div class="form-group">
                <label for="expiry">Expiry Date</label>
                <input type="text" id="expiry" placeholder="MM/YY" maxlength="5" />
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" placeholder="123" maxlength="4" />
            </div>
        </div>

        <div id="successmsg4" style="color:red;font-size:0.82rem;"></div>
        <div id="successmsg1" style="color:red;font-size:0.82rem;"></div>

        <div class="info-banner">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0;margin-top:1px">
                <path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/>
            </svg>
            <div>
                <div class="banner-title">Secure Payment</div>
                <div class="banner-sub">Your card details are encrypted and never stored</div>
            </div>
        </div>

        <div id="successmsg" style="color:red;font-size:0.82rem;"></div>
        

        <div class="agree-row">
            <input type="checkbox" id="agreeTerms" />
            <label for="agreeTerms">I agree to the terms and conditions and cancellation policy</label>
        </div>
        

        <form method="POST" action="{{ route('payment.store') }}" id="paymentForm">
            @csrf
            <input type="hidden" name="flight_id"       id="input-flight-id" />
            <input type="hidden" name="seats_booked"    id="input-seats" />
            <input type="hidden" name="method"          value="credit_card" />
            <input type="hidden" name="card_last_four"  id="input-last-four" />
            <input type="hidden" name="cardholder_name" id="input-card-name" />

            {{-- FIX 2: type="button" + onclick so handlePayment() runs first --}}
            <button type="button" class="pay-btn" id="payBtn" onclick="handlePayment()">Complete Payment</button>
        </form>
    </div>

    {{-- RIGHT: order summary --}}
    <div class="summary-card">
        <h2>Order Summary</h2>
        <div class="summary-row"><span class="label">Flight</span>     <span class="value" id="sum-id">—</span></div>
        <div class="summary-row"><span class="label">Route</span>      <span class="value" id="sum-route">—</span></div>
        <div class="summary-row"><span class="label">Date</span>       <span class="value" id="sum-date">—</span></div>
        <div class="summary-row"><span class="label">Passengers</span> <span class="value" id="sum-passengers">—</span></div>
        <hr class="summary-divider" />
        <div class="summary-row"><span class="label">Subtotal</span>   <span class="value" id="sum-subtotal">—</span></div>
        <div class="summary-row"><span class="label">Tax (15%)</span>  <span class="value" id="sum-tax">—</span></div>
        <hr class="summary-divider" />
        <div class="summary-total">
            <span class="total-label">Total</span>
            <span class="total-amount" id="sum-total">—</span>
        </div>
    </div>

</div>


{{-- BOOKING TABLE --}}
<div class="booking-section">
    <h2>My Current Booking</h2>

    @if(!$booking)
        <div class="empty-msg" id="emptyMsg">
            No booking yet. Complete a payment above to see your reservation here.
        </div>
    @else
        <table class="booking-table" id="bookingTable">
            <thead>
                <tr>
                    <th>Flight</th>
                    <th>Route</th>
                    <th>Date</th>
                    <th>Seats</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="bookingTableBody">
                <tr id="row-{{ $booking->id }}">
                    <td>{{ $booking->flight->flight_number }}</td>
                    <td>{{ $booking->flight->origin }} → {{ $booking->flight->destination }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('M j, Y') }}</td>
                    <td>{{ $booking->seats_booked }}</td>
                    <td><strong>${{ number_format($booking->total_price, 2) }}</strong></td>
                    <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('booking.destroy', $booking->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn"
                                    onclick="return confirm('Cancel this booking?')">Cancel</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
</div>

@endsection


@section('scripts')
<script>

    var TAX_RATE   = 0.15;
var flightData = null;
var raw      = sessionStorage.getItem('selectedFlight');
var selected = raw ? JSON.parse(raw) : null;

@if($flight)
    // came from URL parameters
    flightData = {
        id:             {{ $flight->id }},
        flight_number:  '{{ $flight->flight_number }}',
        origin:         '{{ $flight->origin }}',
        destination:    '{{ $flight->destination }}',
        departure_time: '{{ $flight->departure_time }}',
        price:          {{ $flight->price }},
        passengers:     {{ $passengers }}
    };
    fillSummary(flightData);
@else
    // came from sessionStorage (flights page)
    if (selected && selected.flightId) {
        fetch('/api/flights/' + selected.flightId)
            .then(function(res) { return res.json(); })
            .then(function(data) {
                flightData = data;
                flightData.passengers = parseInt(selected.passengers) || 1;
                fillSummary(flightData);
            });
    }
@endif


// Fill the order summary card 
function fillSummary(f) {
    var subtotal = f.price * f.passengers;
    var tax      = Math.round(subtotal * TAX_RATE * 100) / 100;
    var total    = subtotal + tax;

    var dateText = new Date(f.departure_time).toLocaleDateString('en-US', {
        month: 'short', day: 'numeric', year: 'numeric'
    });

    document.getElementById('sum-id').textContent         = f.flight_number;
    document.getElementById('sum-route').textContent      = f.origin + ' → ' + f.destination;
    document.getElementById('sum-date').textContent       = dateText;
    document.getElementById('sum-passengers').textContent = f.passengers;
    document.getElementById('sum-subtotal').textContent   = '$' + subtotal.toFixed(2);
    document.getElementById('sum-tax').textContent        = '$' + tax.toFixed(2);
    document.getElementById('sum-total').textContent      = '$' + total.toFixed(2);
}


// Validate then submit 
function handlePayment() {

    const cardnb   = document.getElementById('cardNumber').value.replace(/\s/g, '');
    const cardname = document.getElementById('cardName').value.trim();
    const expiry   = document.getElementById('expiry').value.trim();
    const cvv      = document.getElementById('cvv').value.trim();

    const successmsg  = document.getElementById('successmsg');
    const successmsg1 = document.getElementById('successmsg1');
    const successmsg2 = document.getElementById('successmsg2');
    const successmsg3 = document.getElementById('successmsg3');
    const successmsg4 = document.getElementById('successmsg4');


    if (!cardnb || !cardname || !expiry || !cvv) {
        successmsg.innerHTML = 'All fields are required.';
        return;
    }

    if (cardnb.length !== 16) {
        successmsg2.innerHTML = 'The card number must be 16 digits.';
        return;
    }

    if (cardname.length < 5) {
        successmsg3.innerHTML = 'The name must be at least 5 characters.';
        return;
    }

    if (!/^(0[1-9]|1[0-2])\/([0-9]{2})$/.test(expiry)) {
        successmsg4.innerHTML = 'Expiry date must be in MM/YY format with a valid month and year.';
        return;
    }

    if (cvv.length < 3 || cvv.length > 4) {
        successmsg1.innerHTML = 'The CVV must be 3 or 4 digits.';
        return;
    }

    successmsg.innerHTML  = '';
    successmsg1.innerHTML = '';
    successmsg2.innerHTML = '';
    successmsg3.innerHTML = '';
    successmsg4.innerHTML = '';

    if (!document.getElementById('agreeTerms').checked) {
        alert('Please agree to the terms and conditions first.');
        return;
    }

    if (!flightData) {
        alert('No flight selected. Please go back and choose a flight.');
        return;
    }

    var btn         = document.getElementById('payBtn');
    btn.disabled    = true;
    btn.textContent = 'Processing...';

    sendPayment(cardnb, cardname, btn);
}


// ── Fill hidden fields and submit the form ───────────────
function sendPayment(cardNum, cardName, btn) {
    document.getElementById('input-flight-id').value  = flightData.id;
    document.getElementById('input-seats').value      = flightData.passengers;
    document.getElementById('input-last-four').value  = cardNum.slice(-4);
    document.getElementById('input-card-name').value  = cardName;

    document.getElementById('paymentForm').submit();
}



</script>

@endsection