<?php

namespace App\Http\Controllers;

use App\Models\HotelBooking;
use Illuminate\Http\Request;

class HotelBookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:50',
            'age'         => 'required|integer|min:18|max:120',
            'country'     => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'room_type'   => 'required|in:single,double,suite',
            'return_date' => 'required|date|after_or_equal:today',
            'return_time' => 'required',
            'message'     => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();

        HotelBooking::create($validated);

        return back()->with('success', 'Hotel booking submitted successfully! We will contact you shortly.');
    }
}
