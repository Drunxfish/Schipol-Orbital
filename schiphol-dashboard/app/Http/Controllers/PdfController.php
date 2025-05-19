<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;

class PdfController extends Controller
{
    // Builds PDF from view
    public function buildPDF($tracker, $token)
    {
        // Get the booking details
        $booking = Booking::where('tracker', $tracker)
            ->where('confirmation_token', $token)
            ->firstOrFail();

        // load view and pass data
        $pdf = Pdf::loadView('pdf.booking', compact('booking'));

        // Download pdf
        return $pdf->download("Schiphol-Orbital-Ticket-{$booking->tracker}.pdf");
    }
}
