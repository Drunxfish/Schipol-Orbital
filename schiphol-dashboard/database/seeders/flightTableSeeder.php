<?php
namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FlightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aircraftTypes = [
            'Boeing 737 MAX', 'Airbus A321', 'Boeing 787', 
            'Embraer E190', 'Airbus A380', 'Boeing 747', 
            'Airbus A350', 'Boeing 737', 'Airbus A320'
        ];
        
        $servicesOptions = [
            ['WiFi', 'In-flight Entertainment'],
            ['WiFi', 'Extra Legroom'],
            ['WiFi', 'Premium Meals', 'Lounge Access'],
            ['WiFi', 'Premium Meals'],
            ['WiFi', 'Lounge Access'],
            ['WiFi']
        ];
        
        $otherAirports = [
            'Frankfurt Airport', 'Zurich Airport', 'Toronto Pearson', 
            'Berlin Brandenburg', 'Dubai International', 'Los Angeles LAX', 
            'Tokyo Narita', 'Singapore Changi', 'Madrid Barajas', 'Rome Fiumicino'
        ];

        $checkInLocations = [
            'Terminal 1 - Check-in D', 'Terminal 2 - Check-in E', 
            'Terminal 3 - Check-in F', 'Terminal 1 - Check-in H',
            'Terminal 2 - Check-in I', 'Terminal 3 - Check-in J'
        ];

        $flights = [];
        $startDate = Carbon::now();
        $id = 100;
        for ($i = 0; $i < 500; $i++) {
            $departureDate = (clone $startDate)->addDays($i);
            $arrivalDate = (clone $departureDate)->addDay();
            $totalSeats = rand(100, 350);
            $isOriginSchiphol = rand(0, 1) === 1;

            $flights[] = [
                'flight_number' => 'S' . $id + $i,
                'departure_date' => $departureDate->toDateString(),
                'arrival_date' => $arrivalDate->toDateString(),
                'departure_time' => sprintf('%02d:%02d:00', rand(6, 20), rand(0, 59)),
                'arrival_time' => sprintf('%02d:%02d:00', rand(6, 23), rand(0, 59)),
                'aircraft_type' => $aircraftTypes[array_rand($aircraftTypes)],
                'airline' => 'Orbital Airlines',
                'status' => 'Scheduled',
                'check_in_location' => $checkInLocations[array_rand($checkInLocations)],
                'ticket_price' => rand(120, 500) + rand(0, 99) / 100,
                'ticket_status' => 'Available',
                'services' => json_encode($servicesOptions[array_rand($servicesOptions)]),
                'origin' => $isOriginSchiphol ? 'Schiphol Orbital' : $otherAirports[array_rand($otherAirports)],
                'destination' => $isOriginSchiphol ? $otherAirports[array_rand($otherAirports)] : 'Schiphol Orbital',
                'duration' => rand(1,12),
                'seats_total' => $totalSeats,
                'seats_booked' => rand(0, $totalSeats - 10),
                'flight_coordinator_id' => rand(1, 7),
                'gate_id' => rand(1, 4),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Flight::insert($flights);
    }
}
