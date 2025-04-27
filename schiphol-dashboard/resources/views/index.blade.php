@include('layouts/navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schiphol Orbital</title>
    {{--
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    <div class="welcome-container">
        <h1 class="welcome-title">Welcome to Schiphol Orbital</h1>
        <p class="welcome-message">Explore the future of aviation with us.</p>
        <div class="button-group">
            <a href="{{ route('flights.departure') }}" class="welcome-button">Departures</a>
            <a href="{{ route('flights.arrival') }}" class="welcome-button">Arrival</a>
        </div>
    </div>
</body>

</html>