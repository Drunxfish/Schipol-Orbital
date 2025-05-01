@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $flight->origin}}</title>
</head>

<body>
    <a href="{{ route('flights.arrival') }}">
        <button>Back to Arrivals</button>
    </a>
    <div class="flight-arr-details">
        <div class="arTitle">
            <h1>{{ $flight->origin }}</h1>
            <span><i>Arrival flights aren't bookable</i></span>
        </div>
        <div class="arrDt">
            <p>Flight Number: {{ $flight->flight_number }}</p>
            <p>Arrival Date: {{ \Carbon\Carbon::parse($flight->arrival_date)->format('d M') }}</p>
            <p>Arrival Time: {{ \Carbon\Carbon::parse($flight->arrival_time)->format('h:i A') }}</p>
            <p>Origin: {{ "{$flight->origin} -> {$flight->destination}" }}</p>
            <p>Airline: {{ $flight->airline }}</p>
            <p>Status: {{ $flight->status }}</p>
            <p>Expected At: {{ $flight->gate->location }}</p>
            <p>Flight Duration: {{ $flight->duration }} Hours </p>
        </div>
    </div>
</body>

</html>