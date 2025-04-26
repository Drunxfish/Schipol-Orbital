<head>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/body.css') }}">
</head>

<body>
    <header>
        <img src="{{ asset('assets/images/test.png') }}" alt="" class="logo">
        <nav>
            <ul>
                {{-- <li><a href="{{ route('index') }}">Home</a></li> --}}
                {{-- <li><a href="{{ route('flights.index') }}">Flights</a></li> --}}
                {{-- <li><a href="{{ route('bookings.index') }}">Bookings</a></li> --}}
                <li><a href="#">Home</a></li>
                <li><a href="#">Flights</a></li>
                <li><a href="#">Bookings</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>
</body>