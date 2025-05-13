@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Departures</title>
    <link rel="stylesheet" href="{{ asset('css/flights.css') }}">
</head>

<body>
    <section class="flights-container">
        <div class="flights-wrap">
            <div class="flights-search">
                <h1>All flights departing from <span>Schiphol Orbital</span></h1>
                <p>Today, {{ now()->format('d F') }}</p>
                <form method="GET" action="{{ route('flights.departure') }}" class="filter-form">
                    <input type="text" name="destination" placeholder="Destination"
                        value="{{ request('destination') }}">
                    <input type="date" name="date" value="{{ request('date') }}">
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
                                class="flight-date">{{ \Carbon\Carbon::parse($flight->departure_date)->format('d M') }}</span>
                            <div class="flight-details">
                                <span>{{ \Carbon\Carbon::parse($flight->departure_time)->format('h:i A') }}</span>
                                <span class="location">{{ $flight->destination }}</span>
                                <span class="flight-numbers">Flight number: {{ $flight->flight_number }} <br></span>
                                <span class="airline">{{ $flight->airline }}</span>
                            </div>
                            <div class="flight-status">
                                <span
                                    class="status-text {{ strtolower($flight->status) }}">{{ strtolower($flight->status) }}</span>
                                {{-- {{ route('flights.details', ['flight' => $flight->id]) }} --}}
                                <a href="/flights/departure/{{ $flight->id }}" class="details-link">Details</a>
                            </div>
                        </li>
                    @empty
                        <li class="no-flights">No departures found for '{{ $_GET['destination'] ?? ''}}'</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
</body>

</html>