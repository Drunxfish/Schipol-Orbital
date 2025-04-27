@include('layouts.navbar');
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>Departures</h1>
        <ul>
            @foreach ($flights as $flight)
                @if ($flight->destination === 'Schiphol Orbital')
                    <li>
                        Flight {{ $flight->flight_number }} to {{ $flight->destination }} at
                        {{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <div>
        <h1>Arrivals</h1>
        <ul>
            @foreach ($flights as $flight)
                @if ($flight->type === 'arrival')
                    <li>
                        Flight {{ $flight->number }} from {{ $flight->origin }} at {{ $flight->time }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</body>

</html>