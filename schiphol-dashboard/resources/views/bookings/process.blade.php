@include('layouts.bootstrap')
@include('layouts.banner')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking</title>
    <link rel="stylesheet" href="{{ asset('css/body.css') }}">
</head>

<body>
    @if(session('popup_message'))
        <div class="alert alert-dismissible fade show position-fixed top-0 start-0 w-100 border-0 d-flex flex-column justify-content-center align-items-center text-center fw-bold"
            role="alert"
            style="z-index: 2000; background: var(--cozyBackground); color: var(--white); border-color: var(--cozyBackground); font-size: 1.5rem; min-height: 80px; width: 100%; height: 150px; border-top-left-radius: 0; border-top-right-radius: 0;">
            <span class="fs-2 mb-2"><i class="bi bi-exclamation-triangle-fill"></i></span>
            {{ session('popup_message') }}
            <button type="button" class="btn-close ms-2 position-absolute end-0 top-8 m-4" data-bs-dismiss="alert"
                aria-label="Close"
                style="filter: invert(1); box-shadow: none !important; outline: none !important;"></button>
        </div>
    @endif
    <div class="container py-5" style="min-height: 100vh; display: flex; align-items: center;">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <div id="flightFormCarousel" class="carousel slide" data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <div class="mb-2">
                                                <span class="badge bg-secondary text-uppercase px-2 py-1">
                                                    Flight Information
                                                </span>
                                            </div>
                                            <h2 class="fw-bold text-primary mb-0">{{ $flight->destination }}</h2>
                                            <small class="text-muted">{{ $flight->airline }}</small>
                                        </div>
                                        <span class="badge fs-6 text-uppercase px-3 py-2 rounded-pill"
                                            style="background: var(--success); color: var(--white);">
                                            {{ $flight->status }}
                                        </span>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="bg-light rounded-3 p-3 h-100">
                                                <h6 class="text-uppercase text-muted">Departure</h6>
                                                <p class="fs-5 mb-1">
                                                    {{ \Carbon\Carbon::parse($flight->departure_date)->format('d M Y') }},
                                                    {{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}
                                                </p>
                                                <p class="mb-0"><strong>Gate:</strong>
                                                    {{ $flight->gate->location ?? 'TBD' }}</p>
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
                                                <p class="mb-0"><strong>Flight duration:</strong>
                                                    {{ $flight->duration }} hrs</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bg-light rounded-3 p-3 h-500">
                                                <h6 class="text-uppercase text-muted">Flight Info</h6>
                                                <p class="mb-0"><strong>Flight Number:</strong>
                                                    {{ $flight->flight_number }}</p>
                                                <p class="mb-0"><strong>Aircraft:</strong> {{ $flight->aircraft_type }}
                                                </p>
                                                @php
                                                    $services = json_decode($flight->services, true);
                                                @endphp
                                                <p><strong>Services:</strong>
                                                    {{ $services ? implode(', ', $services) : 'None' }}</p>
                                                <p><strong>Business Class Includes:</strong> Meal + Drinks</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="bg-light rounded-3 p-3 h-100">
                                                <h6 class="text-uppercase text-muted">Pricing</h6>
                                                <div class="alert alert-info py-2 px-3 mb-3 small">
                                                    The prices listed below are final and will be applied at the time of
                                                    booking.
                                                    Tickets may also be purchased in person at our official ticket
                                                    counters.
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
                                                    <p class="mb-1"><strong>Base Price:</strong>
                                                        €{{ number_format($ecoPrice, 2) }}</p>
                                                    <p class="mb-1"><strong>Taxes & Fees:</strong>
                                                        €{{ number_format($ecoTax, 2) }}</p>
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
                                    <div class="d-flex justify-content-center mt-4">
                                        <button class="btn btn-primary btn-lg" type="button"
                                            data-bs-target="#flightFormCarousel" data-bs-slide="next">
                                            Continue to Booking
                                        </button>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <form
                                        action="{{ route('bookings.store', ['flight_id' => $flight->id, 'token' => request('token')]) }}"
                                        method="POST" autocomplete="off" class="px-2">
                                        @csrf
                                        <h3 class="fw-bold text-primary mb-0 center">
                                            <i class="bi bi-person-circle me-2"></i>Traveler Information
                                        </h3>
                                        <div class="alert alert-info mb-4 d-flex align-items-center" role="alert">
                                            <i class="bi bi-info-circle-fill me-2"></i>
                                            Please enter traveler details as shown on your passport or ID.
                                        </div>
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label for="traveler_first_name" class="form-label">
                                                    <i class="bi bi-person"></i> First Name
                                                </label>
                                                <input type="text" class="form-control" id="traveler_first_name"
                                                    name="first_name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="traveler_last_name" class="form-label">
                                                    <i class="bi bi-person"></i> Last Name
                                                </label>
                                                <input type="text" class="form-control" id="traveler_last_name"
                                                    name="last_name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="traveler_email" class="form-label">
                                                    <i class="bi bi-envelope"></i> Email
                                                </label>
                                                <input type="email" class="form-control" id="traveler_email"
                                                    name="email" required placeholder="e.g your.email@email.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="traveler_phone" class="form-label">
                                                    <i class="bi bi-telephone"></i> Phone Number
                                                </label>
                                                <input type="text" class="form-control" id="traveler_phone"
                                                    name="phone_number" required placeholder="+31 6 12345678">
                                            </div>
                                            <div class="col-12">
                                                <label for="traveler_address" class="form-label">
                                                    <i class="bi bi-geo-alt"></i> Address
                                                </label>
                                                <input type="text" class="form-control" id="traveler_address"
                                                    name="address" required placeholder="e.g. 123 Main St, Amsterdam">
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <div class="row g-4 align-items-end">
                                            <div class="col-md-6">
                                                <label for="seat_preference" class="form-label">
                                                    <i class="bi bi-layout-sidebar-inset"></i> Seat Preference
                                                </label>
                                                <select class="form-select" id="seat_preference" name="seat_preference"
                                                    required>
                                                    <option value="" selected disabled>Select preference</option>
                                                    <option value="aisle">Aisle <span>&#x1F6C2;</span></option>
                                                    <option value="window">Window <span>&#x1F5BC;</span></option>
                                                    <option value="any">Let us decide</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="seat_class" class="form-label">
                                                    <i class="bi bi-star"></i> Seat Class
                                                </label>
                                                <select class="form-select" id="seat_class" name="seat_class"
                                                    onchange="updatePrice()">
                                                    <option value="economy" data-price="{{ $ecoTotal }}">
                                                        <i class="bi bi-cash-coin"></i> Economy -
                                                        €{{ number_format($ecoTotal, 2) }}
                                                    </option>
                                                    <option value="business" data-price="{{ $businessTotal }}">
                                                        <i class="bi bi-gem"></i> Business & Private -
                                                        €{{ number_format($businessTotal, 2) }}
                                                    </option>
                                                </select>
                                                <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-6 offset-md-6">
                                                <label class="form-label">
                                                    <i class="bi bi-receipt"></i> Final Price:
                                                </label>
                                                <span id="finalPrice"
                                                    class="fw-bold ms-2">€{{ number_format($ecoTotal, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="bi bi-check-circle me-1"></i>Confirm Booking
                                            </button>
                                            <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-lg">
                                                <i class="bi bi-x-circle me-1"></i>Cancel
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-center mt-3">
                                            <button class="btn btn-link" type="button"
                                                data-bs-target="#flightFormCarousel" data-bs-slide="prev">
                                                <i class="bi bi-chevron-left"></i> Previous Step
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updatePrice() {
            var select = document.getElementById('seat_class');
            var price = select.options[select.selectedIndex].getAttribute('data-price');
            document.getElementById('finalPrice').innerText = '€' + parseFloat(price).toFixed(2);
        }
    </script>
</body>

</html>