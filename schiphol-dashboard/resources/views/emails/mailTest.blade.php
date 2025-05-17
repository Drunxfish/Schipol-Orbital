@component('mail::message')
# Welcome to Schiphol Orbital!

Hi {{ $name }},

Thank you for your interest in the **Schiphol Orbital Airplane Program**.
We are excited to introduce our revolutionary orbital flights, offering a unique experience above the clouds and beyond
the ordinary.

**What to Expect:**
- Seamless check-in at our state-of-the-art terminal
- Comfortable seating with panoramic orbital views
- Complimentary zero-gravity refreshments
- Guided tour of the orbital flight deck

Ready to embark on this extraordinary journey?

@component('mail::button', ['url' => 'https://laracasts.com'])
Test Button
@endcomponent

If you have any questions, simply reply to this email.
We look forward to welcoming you aboard!

Thanks,<br>
The Schiphol Orbital Team
@endcomponent