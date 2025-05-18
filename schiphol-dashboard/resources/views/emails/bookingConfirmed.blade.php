@php
    use Carbon\Carbon;
@endphp

@component('mail::message')

# ✈️ Booking Confirmed

Hello {{ $booking->traveler->name ?? 'Traveler' }},

Thank you for choosing **Schiphol Orbital** for your upcoming journey!
We’re excited to have you on board.

@component('mail::panel')
**🔒 Important:** Your personalized booking link will expire on
**{{ Carbon::parse($booking->flight->departure_date)->addDays(2)->format('d M Y') }}** (2 days after your flight
departs).
Please make sure to access or update your booking before then.
@endcomponent

---

### 🧾 Booking Summary
@component('mail::panel')
- **Reference ID:** {{ $booking->tracker ?? 'N/A' }}
- **Passenger:** {{ $booking->traveler->name ?? 'N/A' }}
- **Flight Number:** {{ $booking->flight->flight_number ?? 'N/A' }}
- **Class:** {{ $booking->seat_class ?? 'N/A' }}
- **Seat:** {{ isset($booking->flight->seats_total) ? 'B' . rand(1, $booking->flight->seats_total) : 'N/A' }}

**Departure:**
{{ $booking->flight->origin ?? 'N/A' }} —
{{ Carbon::parse($booking->flight->departure_date ?? '')->format('d M Y') }},
{{ Carbon::parse($booking->flight->departure_time ?? '')->format('H:i') }}

**Arrival:**
{{ $booking->flight->destination ?? 'N/A' }} —
{{ Carbon::parse($booking->flight->arrival_date ?? '')->format('d M Y') }},
{{ Carbon::parse($booking->flight->arrival_time ?? '')->format('H:i') }}
@endcomponent

---

You can view or manage your booking at any time using the secure button below:

@component('mail::button', ['url' => $signedUrl])
📄 View & Manage My Booking
@endcomponent

If you have any questions or need assistance, simply reply to this email. Our support team is always ready to help.

We look forward to providing you with a seamless and enjoyable travel
experience at Schiphol Orbital.

Warm regards,<br>
**The Schiphol Orbital Team**

@endcomponent