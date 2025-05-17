@include('layouts.navbar')
@include('layouts.bootstrap')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $flight->origin}}</title>
    <link rel="stylesheet" href="{{ asset('css/body.css') }}">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="mb-4 text-start">
                            <a href="{{ route('flights.arrival') }}" class="btn btn-outline-primary">Back to
                                Arrivals</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fw-bold text-primary mb-0">{{ $flight->origin }}</h2>
                                <small class="text-muted">{{ $flight->airline }}</small>
                            </div>
                            <span class="badge bg-secondary fs-6 text-uppercase px-3 py-2 rounded-pill">
                                {{ $flight->status }}
                            </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="text-center">
                                <span class="fw-bold">{{ $flight->origin }}</span>
                            </div>
                            <div class="flex-grow-1 mx-1" style="position:relative; height: 24px; min-width:320px;">
                                <svg width="100%" height="24" viewBox="0 0 480 24"
                                    style="position:absolute; top:0; left:0;">
                                    <line x1="0" y1="12" x2="472" y2="12" stroke="#0d6efd" stroke-width="4" />
                                    <polygon points="472,6 480,12 472,18" fill="#0d6efd" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold">{{ $flight->destination }}</span>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <h6 class="text-uppercase text-muted">Arrival</h6>
                                    <p class="fs-5 mb-1">
                                        {{ \Carbon\Carbon::parse($flight->arrival_date)->format('d M Y') }},
                                        {{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}
                                    </p>
                                    <p class="mb-0"><strong>Gate:</strong> {{ $flight->gate->location ?? 'TBD' }}</p>
                                    <p class="mb-0"><strong>Baggage Claim:</strong>
                                        {{ $flight->baggage_claim ?? 'TBD' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <h6 class="text-uppercase text-muted">Route</h6>
                                    <p class="fs-5 mb-1">{{ $flight->origin }} → {{ $flight->destination }}</p>
                                    <p class="mb-0"><strong>Flight duration:</strong> {{ $flight->duration }} hrs</p>
                                    <p class="mb-0"><strong>From:</strong> {{ $flight->origin }}</p>
                                    <p class="mb-0"><strong>To:</strong> {{ $flight->destination }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <h6 class="text-uppercase text-muted">Flight Info</h6>
                                    <p class="mb-0"><strong>Flight Number:</strong> {{ $flight->flight_number }}</p>
                                    <p class="mb-0"><strong>Aircraft:</strong> {{ $flight->aircraft_type }}</p>
                                    @php
                                        $services = json_decode($flight->services, true);
                                    @endphp
                                    <p><strong>Services:</strong> {{ $services ? implode(', ', $services) : 'None' }}
                                    </p>
                                    <p><strong>Business Class Includes:</strong> Meal + Drinks</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <h6 class="text-uppercase text-muted">Pricing</h6>
                                    <div class="alert py-2 px-3 mb-3 small"
                                        style="background-color: var(--cozyBackground); color: var(--white); border: none;">
                                        The prices listed below are for informational purposes only. This flight is
                                        arriving and cannot be booked.
                                    </div>
                                    @php
                                        $ecoPrice = $flight->ticket_price;
                                        $businessPrice = $ecoPrice * 1.7;
                                        $ecoTax = match (true) {
                                            $ecoPrice < 100 => 10,
                                            $ecoPrice < 300 => 25,
                                            default => 40,
                                        };
                                        $businessTax = match (true) {
                                            $businessPrice < 100 => 10,
                                            $businessPrice < 300 => 25,
                                            default => 40,
                                        };
                                        $ecoTotal = $ecoPrice + $ecoTax;
                                        $businessTotal = $businessPrice + $businessTax;
                                    @endphp
                                    <div class="mb-3">
                                        <strong>Economy Class</strong>
                                        <p class="mb-1"><strong>Base Price:</strong> €{{ number_format($ecoPrice, 2) }}
                                        </p>
                                        <p class="mb-1"><strong>Taxes & Fees:</strong> €{{ number_format($ecoTax, 2) }}
                                        </p>
                                        <p class="mb-0 fw-bold"><strong>Total:</strong>
                                            €{{ number_format($ecoTotal, 2) }}</p>
                                    </div>
                                    <div>
                                        <strong>Business Class</strong>
                                        <p class="mb-1"><strong>Base Price:</strong>
                                            €{{ number_format($businessPrice, 2) }}</p>
                                        <p class="mb-1"><strong>Taxes & Fees:</strong>
                                            €{{ number_format($businessTax, 2) }}</p>
                                        <p class="mb-0 fw-bold"><strong>Total:</strong>
                                            €{{ number_format($businessTotal, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>