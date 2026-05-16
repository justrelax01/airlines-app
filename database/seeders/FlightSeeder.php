<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run()
    {
        $flights = [
            [
                'flight_number'  => 'AA1425',
                'origin'         => 'New York',
                'destination'    => 'London',
                'departure_time' => '2026-05-15 07:30:00',
                'arrival_time'   => '2026-05-15 19:45:00',
                'available_seats' => 120,
                'price'          => 850.00,
                'status'         => 'scheduled',
            ],
            [
                'flight_number'  => 'BA2890',
                'origin'         => 'Los Angeles',
                'destination'    => 'Tokyo',
                'departure_time' => '2026-05-18 14:20:00',
                'arrival_time'   => '2026-05-19 18:30:00',
                'available_seats' => 80,
                'price'          => 2400.00,
                'status'         => 'scheduled',
            ],
            [
                'flight_number'  => 'DL5673',
                'origin'         => 'Miami',
                'destination'    => 'Paris',
                'departure_time' => '2026-06-02 09:15:00',
                'arrival_time'   => '2026-06-02 23:40:00',
                'available_seats' => 200,
                'price'          => 1200.00,
                'status'         => 'scheduled',
            ],
            [
                'flight_number'  => 'BP4321',
                'origin'         => 'Beirut',
                'destination'    => 'Paris',
                'departure_time' => '2026-07-05 12:00:00',
                'arrival_time'   => '2026-07-05 16:30:00',
                'available_seats' => 60,
                'price'          => 1000.00,
                'status'         => 'scheduled',
            ],
            [
                'flight_number'  => 'EK7821',
                'origin'         => 'Dubai',
                'destination'    => 'New York',
                'departure_time' => '2026-06-15 02:30:00',
                'arrival_time'   => '2026-06-15 14:00:00',
                'available_seats' => 150,
                'price'          => 1800.00,
                'status'         => 'scheduled',
            ],
            [
                'flight_number'  => 'QR3312',
                'origin'         => 'Doha',
                'destination'    => 'Sydney',
                'departure_time' => '2026-07-20 23:50:00',
                'arrival_time'   => '2026-07-21 22:10:00',
                'available_seats' => 90,
                'price'          => 2100.00,
                'status'         => 'scheduled',
            ],
        ];

        foreach ($flights as $flight) {
            Flight::firstOrCreate(
                ['flight_number' => $flight['flight_number']],
                $flight
            );
        }
    }
}
