@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arrivals</title>
    <link rel="stylesheet" href="{{ asset('css/flights.css') }}">
</head>

<body>
    <section class="flights-container">
        <div class="flights-wrap">
            <div class="flights-search">
                <h1>All flights arriving at <span>Schiphol Orbital</span></h1>
                <p>Today, {{ now()->format('d F') }}</p>
                <form method="GET" action="{{ route('flights.arrival') }}" class="filter-form">
                    <input type="text" name="origin" placeholder="Origin" value="{{ request('origin') }}">
                    <button type="submit">
                        <span class="material-symbols-rounded">
                            search
                        </span>
                    </button>
                </form>
            </div>
            <div class="flights-list">
                <ul>
                    @forelse($flights as $flight)
                        <li class="flight-item">
                            <span
                                class="flight-date">{{ \Carbon\Carbon::parse($flight->arrival_date)->format('d M') }}</span>
                            <div class="flight-details">
                                <span>{{ \Carbon\Carbon::parse($flight->arrival_time)->format('h:i A') }}</span>
                                <span class="location">{{ $flight->origin }} - {{ $flight->origin_code }}</span>
                                <span class="flight-numbers">Flight number: {{ $flight->flight_number }} <br></span>
                                <span class="airline">{{ $flight->airline }}</span>
                            </div>
                            <div class="flight-status">
                                <a href="" class="details-link">Details</a>
                            </div>
                        </li>
                    @empty
                        <li>No flights found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
</body>

</html>