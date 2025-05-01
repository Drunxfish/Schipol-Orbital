<head>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/body.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
</head>

<body>
    <header>
        <img src="{{ asset('assets/images/test.png') }}" alt="logo" class="logo">
        <nav>
            <ul>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('flights.departure') }}">Departures</a></li>
                <li><a href="{{ route('flights.arrival') }}">Arrival</a></li>
                {{-- <li><a href="{{ route('bookings.index') }}">Bookings</a></li> --}}
                <li><a href="#">Contact</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>
</body>