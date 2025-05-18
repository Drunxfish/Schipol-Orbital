@include('layouts.bootstrap')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schiphol Orbital</title>
    <link rel="stylesheet" href="{{ asset('assets/css/body.css') }}">
</head>

<body style="background: var(--yellow); height: 100vh; overflow: hidden;">
    <div style="position: absolute; top: 24px; left: 24px; z-index: 10;">
        <img src="{{ asset('assets/icons/rel.png') }}" alt="Schiphol Orbit Logo"
            style="max-width: 120px; width: 100%; height: auto; display: block; filter: drop-shadow(0 4px 16px var(--darkPurp));">
    </div>
    <section class="py-5" style="height: 100vh;">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center"
            style="height: 100%;">
            <div class="mb-3 w-100 d-flex justify-content-center" style="margin-top: -40px;">
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center" style="width: 100%;">
                <div class="card border-0 shadow rounded-4 p-5"
                    style="max-width: 620px; width: 100%; background: rgba(255,255,255,0.97);">
                    <div class="text-center">
                        <div class="mb-4">
                            <svg width="100" height="100" fill="none" viewBox="0 0 64 64">
                                <circle cx="32" cy="32" r="32" fill="#fee2e2" />
                                <path d="M20 44L44 20" stroke="#ef4444" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M20 20L44 44" stroke="#ef4444" stroke-width="4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h1 class="fw-bold text-danger mb-3" style="font-size:3.2rem;">Booking Canceled!</h1>
                        <div class="text-start mx-auto" style="max-width: 500px;">
                            <p class="text-secondary mb-0" style="font-size:1.6rem;">
                                - Your booking has been successfully canceled.<br>
                                A cancellation confirmation has been sent to your email address.<br>
                                Please check your inbox (and spam or junk folder) for details.
                            </p>
                        </div>
                        <div class="mt-5">
                            <a href="{{ route('index') }}" class="btn btn-primary btn-lg px-5">
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>