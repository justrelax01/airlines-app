<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Bookings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div style="background:#d1fae5;color:#065f46;padding:14px 18px;border-radius:8px;margin-bottom:20px;font-weight:600;">
                    {{ session('success') }}
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-10 text-center text-gray-500">
                        <p style="font-size:1.1rem;margin-bottom:16px;">You have no bookings yet.</p>
                        <a href="{{ route('flights') }}"
                           style="display:inline-block;background:#2563eb;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                            Browse Flights
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <table style="width:100%;border-collapse:collapse;font-size:14px;">
                            <thead>
                                <tr style="background:#f8fafc;text-align:left;">
                                    <th style="padding:12px 16px;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;">Flight</th>
                                    <th style="padding:12px 16px;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;">Route</th>
                                    <th style="padding:12px 16px;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;">Departure</th>
                                    <th style="padding:12px 16px;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;">Seats</th>
                                    <th style="padding:12px 16px;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;">Total</th>
                                    <th style="padding:12px 16px;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;">Status</th>
                                    <th style="padding:12px 16px;font-weight:600;color:#374151;border-bottom:2px solid #e5e7eb;">Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:12px 16px;font-weight:600;color:#2563eb;">
                                        {{ $booking->flight?->flight_number ?? '—' }}
                                    </td>
                                    <td style="padding:12px 16px;color:#374151;">
                                        {{ $booking->flight?->origin ?? '—' }} → {{ $booking->flight?->destination ?? '—' }}
                                    </td>
                                    <td style="padding:12px 16px;color:#6b7280;">
                                        {{ $booking->flight ? \Carbon\Carbon::parse($booking->flight->departure_time)->format('M j, Y H:i') : '—' }}
                                    </td>
                                    <td style="padding:12px 16px;text-align:center;">
                                        {{ $booking->seats_booked }}
                                    </td>
                                    <td style="padding:12px 16px;font-weight:600;">
                                        ${{ number_format($booking->total_price, 2) }}
                                    </td>
                                    <td style="padding:12px 16px;">
                                        @php
                                            $colors = ['confirmed'=>'#065f46;background:#d1fae5','pending'=>'#92400e;background:#fef3c7','cancelled'=>'#991b1b;background:#fee2e2'];
                                            $style  = $colors[$booking->status] ?? '#374151;background:#f3f4f6';
                                        @endphp
                                        <span style="padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;color:{{ $style }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td style="padding:12px 16px;color:#6b7280;">
                                        @if($booking->payment)
                                            {{ ucfirst(str_replace('_', ' ', $booking->payment->method)) }}
                                            <span style="font-size:11px;display:block;color:#9ca3af;">
                                                {{ ucfirst($booking->payment->payment_status) }}
                                            </span>
                                        @else
                                            <span style="color:#d1d5db;">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
