<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Flight Reservation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div style="background:#d1fae5;color:#065f46;padding:14px 18px;border-radius:8px;margin-bottom:20px;font-weight:600;">
                    {{ session('success') }}
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-12">
                    <div style="font-size: 3rem; margin-bottom: 15px;">✈️</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Ready to take off?</h3>
                    <p class="text-gray-500 mb-6">You don't have an active flight reservation at the moment. Each user is allowed one active booking.</p>
                    <a href="{{ route('flights') }}"
                       style="display:inline-block;background:#2563eb;color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:600;box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);">
                        Search & Book Flights
                    </a>
                </div>
            @else
                @php 
                    $booking = $bookings->first(); 
                @endphp
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                    <div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);" class="p-6 text-white flex justify-between items-center">
                        <div>
                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.8;">Boarding Pass Reference</span>
                            <h3 class="text-xl font-mono font-bold tracking-wider">{{ $booking->payment->id ?? 'BK-'.$booking->id }}</h3>
                        </div>
                        <div class="text-right">
                            @php
                                $colors = ['confirmed'=>'#d1fae5;color:#065f46','pending'=>'#fef3c7;color:#92400e','cancelled'=>'#fee2e2;color:#991b1b'];
                                $badgeStyle = $colors[$booking->status] ?? '#f3f4f6;color:#374151';
                            @endphp
                            <span style="padding:6px 14px;border-radius:20px;font-size:12px;font-weight:700;{{ $badgeStyle }}">
                                ● {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 bg-white">
                        <div class="grid grid-cols-3 gap-4 items-center text-center mb-6">
                            <div class="text-left">
                                <span class="text-xs text-gray-400 block font-medium">ORIGIN</span>
                                <span class="text-2xl font-black text-gray-800">{{ $booking->flight?->origin ?? '—' }}</span>
                            </div>
                            <div class="relative flex flex-col items-center">
                                <span class="text-xs text-blue-500 font-bold px-2 py-0.5 bg-blue-50 rounded-full mb-1">{{ $booking->flight?->flight_number ?? '—' }}</span>
                                <div style="border-top: 2px dashed #cbd5e1; width: 100%; position: absolute; top: 75%; z-index: 1;"></div>
                                <span style="position: relative; z-index: 2; background: #fff; padding: 0 8px; font-size: 1.25rem;">✈️</span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs text-gray-400 block font-medium">DESTINATION</span>
                                <span class="text-2xl font-black text-gray-800">{{ $booking->flight?->destination ?? '—' }}</span>
                            </div>
                        </div>

                        <hr style="border-color: #f1f5f9; margin-bottom: 1.5rem;">

                        <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm">
                            <div>
                                <span class="text-xs text-gray-400 block">DEPARTURE TIME</span>
                                <strong class="text-gray-700 font-semibold">
                                    {{ $booking->flight ? \Carbon\Carbon::parse($booking->flight->departure_time)->format('M j, Y — H:i') : '—' }}
                                </strong>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">PASSENGER SEATS</span>
                                <strong class="text-gray-700 font-semibold">{{ $booking->seats_booked }} Seat(s)</strong>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">PAYMENT METHOD</span>
                                <strong class="text-gray-700 font-semibold">
                                    @if($booking->payment)
                                        {{ ucfirst(str_replace('_', ' ', $booking->payment->method)) }} 
                                        <span class="text-xs font-normal text-gray-400">({{ ucfirst($booking->payment->payment_status) }})</span>
                                    @else
                                        <span class="text-gray-300">Unpaid</span>
                                    @endif
                                </strong>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">TOTAL FARE</span>
                                <strong class="text-blue-600 font-bold text-base">${{ number_format($booking->total_price, 2) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div style="background-image: radial-gradient(circle at 10px dashed, transparent 10px, #fff 10px); height: 20px; background-color: #f8fafc; border-top: 1px dashed #e2e8f0; border-bottom: 1px dashed #e2e8f0;"></div>

                    <div class="p-6 bg-gray-50 text-center sm:rounded-b-2xl">
                        <div style="display: inline-flex; gap: 2px; background: #000; padding: 15px 30px; border-radius: 4px; filter: opacity(0.85);">
                            @for ($i = 0; $i < 25; $i++)
                                <div style="width: {{ ($i % 3 == 0) ? '3px' : (($i % 2 == 0) ? '1px' : '2px') }}; height: 30px; background: #fff;"></div>
                            @endfor
                        </div>
                        <p class="text-xs text-gray-400 mt-2 font-mono">SCAN AT GATE FOR BOARDING</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>