{{-- @include('layouts/navbar') --}}
@include('layouts.bootstrap')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schiphol Orbital</title>
    {{--
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/body.css') }}">
</head>

<body>
    <section class="py-5" style="background: var(--white); height: 100vh; overflow: hidden;">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center"
            style="height: 100%;">
            <div class="mb-3 w-100 d-flex justify-content-center" style="margin-top: -40px;">
                <img src="{{ asset('assets/images/banner.png') }}" alt="Schiphol Orbit Logo"
                    style="max-width: 520px; width: 100%; height: auto; display: block; filter: drop-shadow(0 4px 32px var(--darkPurp));">
            </div>
            <h1 class="display-3 fw-bold"
                style="color: var(--purp); letter-spacing: 3px; text-shadow: 0 4px 24px var(--off-white);">
                Welcome to <span style="color: var(--yellow);">Schiphol Orbital</span>
            </h1>
            <p class="lead mb-4" style="color: var(--dark-gray); font-size: 1.5rem; max-width: 640px;">
                Your gateway to a smarter, smoother airport experience. Track flights, explore services, buy tickets,
                and enjoy your journey.
            </p>
            <div class="d-flex gap-4 mt-4 flex-wrap justify-content-center">
                <a href="{{ route('flights.departure') }}" class="btn btn-primary btn-lg px-5 shadow"
                    style="font-weight: 600; border-radius: 24px; background: var(--yellow); color: var(--black); border: none;">
                    Departures
                </a>
                <a href="{{ route('flights.arrival') }}" class="btn btn-outline-primary btn-lg px-5 shadow"
                    style="font-weight: 600; border-radius: 24px; border-width: 2px; color: var(--purp); border-color: var(--purp); background: var(--white);">
                    Arrivals
                </a>
            </div>
        </div>
    </section>
</body>

</html>