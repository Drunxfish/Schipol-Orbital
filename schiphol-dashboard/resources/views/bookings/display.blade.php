@include('layouts.bootstrap')
@include('layouts.banner')
<!DOCTYPE html>
@php
    use Carbon\Carbon;

    // If booking is canceled abort
    if (strtolower($booking->status) === 'canceled') {
        abort(404);
    }

    // Deadline for cancelation 
    $cancelDeadline = Carbon::parse($booking->flight->departure_date)
        ->subDays(2)
        ->endOfDay();

    $cancelable = now()->lessThanOrEqualTo($cancelDeadline);
@endphp
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
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center"
        style="; overflow-x: hidden;">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-xl-10 col-xxl-9">
                <div class="card shadow-lg border-0 rounded-5"
                    style="font-size: 1.08rem; background: var(--white); color: var(--black); overflow: hidden;">
                    <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 py-4 px-4"
                        style="background: linear-gradient(90deg, var(--off-white) 60%, var(--backgroundSecondary) 100%); color: var(--black); border-top-left-radius: 2rem; border-top-right-radius: 2rem; border-bottom: 1px solid var(--gray);">
                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 48px; height: 48px; background: var(--lightest-blue);">
                                <i class="bi bi-ticket-perforated-fill fs-2" style="color: var(--purp);"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 1.15rem; letter-spacing: 0.01em;">Booking
                                    Reference</div>
                                <span class="ms-0 ms-md-2 fw-monospace"
                                    style="color: var(--navy-blue); font-size: 1.05rem; letter-spacing: 0.07em; word-break: break-all; display: inline-block; max-width: 340px; overflow-wrap: break-word;">
                                    {{ \Illuminate\Support\Str::upper(Str::limit($booking->tracker, 16, '...')) }}
                                    @if(strlen($booking->tracker) > 16)
                                        <span class="text-muted" style="font-size: 0.9em;"
                                            title="{{ $booking->tracker }}">&#9432;</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ URL::signedRoute('download.report', ['tracker' => $booking->tracker, 'token' => $booking->confirmation_token]) }}"
                                class="btn btn-primary">
                                Download PDF
                            </a>
                            <span class="fs-6 px-4 py-2 align-self-md-center rounded-pill"
                                style="min-width: 130px; text-align: center; font-weight: 600; letter-spacing: 0.04em; background: var(--purp); color: var(--white);">
                                {{ ucfirst($booking->flight->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body px-4 py-4"
                        style="background: var(--off-white); border-bottom-left-radius: 2rem; border-bottom-right-radius: 2rem;">
                        <div class="row mb-4 g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 shadow-sm h-100" style="background: var(--white);">
                                    <h5 class="fw-semibold mb-3" style="color: var(--purp);"><i
                                            class="bi bi-person-circle me-2"></i>Passenger</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-transparent border-0"><strong>Name:</strong>
                                            {{ $booking->traveler->name }}</li>
                                        <li class="list-group-item bg-transparent border-0"><strong>Email:</strong>
                                            {{ $booking->traveler->email }}</li>
                                        <li class="list-group-item bg-transparent border-0 text-muted">
                                            <em>Phone number and address are not displayed for privacy reasons.</em>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 shadow-sm h-100" style="background: var(--white);">
                                    <h5 class="fw-semibold mb-3" style="color: var(--purp);"><i
                                            class="bi bi-airplane-engines-fill me-2"></i>Flight</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-transparent border-0"><strong>Flight #:</strong>
                                            {{ $booking->flight->flight_number }}</li>
                                        <li class="list-group-item bg-transparent border-0"><strong>Airline:</strong>
                                            {{ $booking->flight->airline }}</li>
                                        <li class="list-group-item bg-transparent border-0"><strong>Aircraft:</strong>
                                            {{ $booking->flight->aircraft_type }}</li>
                                        <li class="list-group-item bg-transparent border-0">
                                            <strong>Route:</strong>
                                            {{ $booking->flight->origin }}
                                            <span class="mx-2"><i class="bi bi-arrow-right"></i></span>
                                            {{ $booking->flight->destination }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 shadow-sm h-100" style="background: var(--white);">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-transparent border-0">
                                            <strong>Departure:</strong>
                                            {{ Carbon::parse($booking->flight->departure_date)->format('d M Y') }}
                                            at {{ Carbon::parse($booking->flight->departure_time)->format('H:i') }}
                                        </li>
                                        <li class="list-group-item bg-transparent border-0">
                                            <strong>Arrival:</strong>
                                            {{ Carbon::parse($booking->flight->arrival_date)->format('d M Y') }}
                                            at {{ Carbon::parse($booking->flight->arrival_time)->format('H:i') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 shadow-sm h-100" style="background: var(--white);">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-transparent border-0">
                                            <strong>Seat Class:</strong> {{ ucfirst($booking->seat_class) }}<br>
                                            <strong>Preference:</strong>
                                            {{ ucfirst($booking->seat_preference) ?? 'Any' }}
                                            @if(!empty($booking->seat))
                                                <br><strong>Seat:</strong> {{ $booking->seat }}
                                            @endif
                                        </li>
                                        <li class="list-group-item bg-transparent border-0">
                                            <strong>Total Cost:</strong>
                                            <span class="fs-4 fw-bold"
                                                style="color: var(--success);">€{{ number_format($booking->total_cost, 2) }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3 flex-wrap">
                            @if ($cancelable)
                                <form id="cancel-booking-form"
                                    action="{{ URL::signedRoute('bookings.cancel', ['tracker' => $booking->tracker, 'token' => $booking->confirmation_token]) }}"
                                    method="POST" class="me-2 mb-2">
                                    @csrf
                                    <button type="button" class="btn px-4 py-2 fs-5 rounded-3 shadow-sm"
                                        style="background: var(--error); color: var(--white); border: none;"
                                        onclick="showCancelModal()">
                                        <i class="bi bi-x-circle me-1"></i> Cancel Booking
                                    </button>
                                </form>

                                <!-- Modal -->
                                <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to cancel this booking? This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    keep booking</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="submitCancelForm()">Yes, cancel booking</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function showCancelModal() {
                                        var modal = new bootstrap.Modal(document.getElementById('cancelModal'));
                                        modal.show();
                                    }
                                    function submitCancelForm() {
                                        document.getElementById('cancel-booking-form').submit();
                                    }
                                </script>
                            @else
                                <div class="alert mb-0 px-4 py-2 d-flex align-items-center rounded-3 shadow-sm fs-5"
                                    style="background: var(--yellow); color: var(--black); border: none;">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    This booking is no longer cancelable.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>