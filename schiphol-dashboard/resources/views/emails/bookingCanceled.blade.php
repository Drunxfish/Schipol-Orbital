@component('mail::message')

# ❌ Booking Canceled

Hello {{ $booking->traveler->name ?? 'Traveler' }},

We regret to inform you that your booking with **Schiphol Orbital** has been canceled.

@component('mail::panel')
**💸 Refund Notice:**
Your payment will be refunded to your original payment method within **14 working days**.
If you do not receive your refund within this period, please contact our support team by replying to this email.
@endcomponent2

---

### 🧾 Booking Summary
@component('mail::panel')
- **Reference ID:** {{ $booking->tracker ?? 'N/A' }}
- **Passenger:** {{ $booking->traveler->name ?? 'N/A' }}
- **Flight Number:** {{ $booking->flight->flight_number ?? 'N/A' }}
- **Class:** {{ $booking->seat_class ?? 'N/A' }}
- **Seat:** {{ isset($booking->flight->seats_total) ? 'B' . rand(1, $booking->flight->seats_total) : 'N/A' }}
- **Status:** Canceled
@endcomponent

---

If you have any questions or need further assistance, simply reply to this email. Our support team is here to help.

Thank you for considering Schiphol Orbital.
We hope to serve you in the future.

Warm regards,<br>
**The Schiphol Orbital Team**

@endcomponent