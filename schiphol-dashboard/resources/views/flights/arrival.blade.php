@include('layouts.navbar')
@include('layouts.bootstrap')
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
        <div class="flights-wrap shadow-sm">
            <div class="flights-search mb-4">
                <h1>All flights arriving at <span>Schiphol Orbital</span></h1>
                <p class="text-muted">Today, {{ now()->format('d F') }}</p>
                <form method="GET" action="{{ route('flights.arrival') }}" class="filter-form d-flex align-items-center mb-3">
                    <input type="text" name="origin" placeholder="Origin"
                        value="{{ request('origin') }}" class="form-control me-2" style="max-width:180px;">
                    <input type="date" name="date" value="{{ request('date') }}" class="form-control me-2" style="max-width:160px;">
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <span class="material-symbols-rounded me-1">
                            search
                        </span>
                        Search
                    </button>
                </form>
            </div>
            <div class="flights-list">
                <ul>
                    @forelse($flights as $flight)
                        <li class="flight-item">
                            <span class="flight-date">{{ \Carbon\Carbon::parse($flight->arrival_date)->format('d M') }}</span>
                            <div class="flight-details">
                                <span>{{ \Carbon\Carbon::parse($flight->arrival_time)->format('h:i A') }}</span>
                                <span class="location">{{ $flight->origin }}</span>
                                <span class="flight-numbers">Flight number: {{ $flight->flight_number }}</span>
                                <span class="airline">{{ $flight->airline }}</span>
                            </div>
                            <div class="flight-status">
                                <span class="status-text {{ strtolower($flight->status) }}">{{ strtolower($flight->status) }}</span>
                                <a href="/flights/arrival/{{ $flight->id }}" class="details-link">Details</a>
                            </div>
                        </li>
                    @empty
                        <li class="no-flights">No arrivals found for '{{ request('origin') }}'</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
</body>

</html>