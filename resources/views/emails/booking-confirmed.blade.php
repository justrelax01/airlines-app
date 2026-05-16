<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background:#f0f4ff; margin:0; padding:40px 20px; color:#1a202c; }
        .card { background:#fff; max-width:560px; margin:0 auto; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08); }
        .header { background:#2563eb; color:#fff; padding:32px 36px; }
        .header h1 { margin:0 0 4px; font-size:22px; }
        .header p { margin:0; opacity:.85; font-size:14px; }
        .body { padding:32px 36px; }
        .ref { background:#eff6ff; border-left:4px solid #2563eb; padding:14px 18px; border-radius:6px; margin-bottom:24px; }
        .ref span { display:block; font-size:11px; text-transform:uppercase; letter-spacing:.5px; color:#6b7280; }
        .ref strong { font-size:20px; color:#2563eb; letter-spacing:1px; }
        .row { display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #f1f5f9; font-size:14px; }
        .row:last-child { border-bottom:none; }
        .label { color:#6b7280; }
        .footer { background:#f8fafc; padding:20px 36px; text-align:center; font-size:12px; color:#9ca3af; }
    </style>
</head>
<body>
<div class="card">
    <div class="header">
        <h1>✈ Booking Confirmed!</h1>
        <p>Thank you for flying with SkyWings. Your booking is confirmed.</p>
    </div>
    <div class="body">
        <div class="ref">
            <span>Booking Reference</span>
            <strong>{{ $ref }}</strong>
        </div>

        <div class="row">
            <span class="label">Passenger</span>
            <span>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</span>
        </div>
        <div class="row">
            <span class="label">Flight</span>
            <span>{{ $booking->flight->flight_number }}</span>
        </div>
        <div class="row">
            <span class="label">Route</span>
            <span>{{ $booking->flight->origin }} → {{ $booking->flight->destination }}</span>
        </div>
        <div class="row">
            <span class="label">Departure</span>
            <span>{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('D, M j Y — H:i') }}</span>
        </div>
        <div class="row">
            <span class="label">Seats</span>
            <span>{{ $booking->seats_booked }}</span>
        </div>
        <div class="row">
            <span class="label">Total Paid</span>
            <span><strong>${{ number_format($booking->total_price, 2) }}</strong></span>
        </div>

        <p style="margin-top:24px;font-size:13px;color:#6b7280;">
            Please arrive at the airport at least 2 hours before departure. Keep this reference number handy at check-in.
        </p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} SkyWings Airlines &mdash; All rights reserved
    </div>
</div>
</body>
</html>
