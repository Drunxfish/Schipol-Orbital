@include('layouts.navbar')
@include('layouts.bootstrap')
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $flight->destination ?? 'Details'}}</title>
    <link rel="stylesheet" href="{{ asset('css/body.css') }}">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="mb-4 text-start">
                            <a href="{{ route('flights.departure') }}" class="btn btn-outline-primary">
                                Back to Departures
                            </a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="fw-bold text-primary mb-0">{{ $flight->destination }}</h2>
                                <small class="text-muted">{{ $flight->airline }}</small>
                            </div>
                            <span class="badge bg-secondary fs-6 text-uppercase px-3 py-2 rounded-pill">
                                {{ $flight->status }}
                            </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="text-center">
                                <span class="fw-bold" style="color: var(--cozyBackground);">{{ $flight->origin }}</span>
                            </div>
                            <div class="flex-grow-1 mx-1" style="position:relative; height: 24px; min-width:480px;">
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
                                    <h6 class="text-uppercase text-muted">Departure</h6>
                                    <p class="fs-5 mb-1">
                                        {{ \Carbon\Carbon::parse($flight->departure_date)->format('d M Y') }},
                                        {{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}
                                    </p>
                                    <p class="mb-0"><strong>Gate:</strong> {{ $flight->gate->location ?? 'TBD' }}</p>
                                    <p class="mb-0"><strong>Boarding:</strong>
                                        {{ \Carbon\Carbon::parse($flight->departure_time)->subMinutes(45)->format('h:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <h6 class="text-uppercase text-muted">Destination</h6>
                                    <p class="fs-5 mb-1">{{ $flight->destination }}</p>
                                    <p class="mb-0"><strong>Route:</strong>
                                        {{ "{$flight->origin} → {$flight->destination}" }}</p>
                                    <p class="mb-0"><strong>Flight duration:</strong> {{ $flight->duration }} hrs</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-500">
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
                                        The prices listed below are final and will be applied at the time of booking.
                                        Tickets may also be purchased in person at our official ticket counters.
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
                            <div class="col-md-100 d-flex align-items-center justify-content-center">
                                <div class="bg-light rounded-3 p-3 w-100 d-flex flex-column align-items-center">
                                    <button type="button" class="btn btn-primary btn-lg w-75 mt-2"
                                        data-bs-toggle="modal" data-bs-target="#bookingModal">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('bookings.confirmation', ['flight_id' => $flight->id]) }}">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="bookingModalLabel">
                            <i class="bi bi-airplane-engines-fill me-2"></i>
                            Book Your Flight!
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert d-flex align-items-center mb-3" role="alert"
                            style="background-color: var(--cozyBackground); color: var(--white);">
                            <i class="bi bi-envelope-paper-heart-fill me-2 fs-4"></i>
                            <div class="alert py-2 px-3 mb-3 small"
                                style="background-color: var(--cozyBackground); color: var(--white); border: none;">
                                After booking, a flight confirmation will be sent to your email. Once confirmed, you
                                will be redirected to the booking page to provide your details such as name, address,
                                and other required information to complete booking.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="namelastname@email.com">
                        </div>
                        <div class="text-center mt-4">
                            <div class="small text-muted mt-2">Ready for takeoff!</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i> Book Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => { scrollBy(100, 200); });
    </script>
</body>

</html>