@component('mail::message')
@component('mail::panel')
> **Please note:** This confirmation link will expire in 30 minutes,
@endcomponent
# Booking Confirmation Required

Dear Traveler,

Thank you for booking with the **Schiphol Orbital Airplane Program**!
To secure your seat on this extraordinary journey, please confirm your booking and provide your passenger details by
clicking the button below.

@component('mail::button', ['url' => $signedUrl])
Confirm & Complete Your Booking
@endcomponent


**What happens next?**
- You will be asked to fill in your name, email, address, and other required information.
- Once you complete the form and confirm, we will finalize your reservation.
- You will receive further instructions and your boarding details.
- If you do not complete this step, your booking will not be completed.

If you have any questions, simply reply to this email.
We look forward to welcoming you aboard!

Best Travels,<br>
The Schiphol Orbital Team
@endcomponent