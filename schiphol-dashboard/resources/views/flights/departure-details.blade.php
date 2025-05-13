@include('layouts.navbar')
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $flight->destination }}</title>
</head>

<body>
    <a href="{{ route('flights.departure') }}">
        <button>Back to Departures</button>
    </a>
    <div class="flight-dep-details">
        <div class="dpTitle">
            <h1>{{ $flight->destination }}</h1>
        </div>
        <div class="depDt">
            <p>Flight Number: {{ $flight->flight_number }}</p>
            <p>Departure Date: {{ \Carbon\Carbon::parse($flight->departure_date)->format('d M') }}</p>
            <p>Departure Time: {{ \Carbon\Carbon::parse($flight->departure_time)->format('h:i A') }}</p>
            <p>Destination: {{ "{$flight->origin} -> {$flight->destination}" }}</p>
            <p>Airline: {{ $flight->airline }}</p>
            <p>Status: {{ $flight->status }}</p>
            <p>{{ $flight->gate->location }}</p>
            <p>Boarding Time: {{ \Carbon\Carbon::parse($flight->departure_time)->subMinutes(45)->format('h:i A') }}</p>
            <p>Flight Duration: {{ $flight->duration }} Hours </p>
        </div>

        <!-- To be implemented ! -->
        <div class="bookingsType">
            <a href=""><button>Book Now</button></a>
        </div>
    </div>

</body>

</html>