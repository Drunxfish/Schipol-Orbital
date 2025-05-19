@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Ticket - Schiphol Orbital</title>
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #fff;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .ticket-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #1a237e;
            border-radius: 10px;
            background: #f9f9f9;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden;
        }

        .ticket-header {
            background: #1a237e;
            color: #fff;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center;
        }

        .ticket-header span {
            font-size: 1.5em;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .ticket-body {
            padding: 15px;
        }

        .ticket-section {
            border: 1px solid #bdbdbd;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 15px;
            background: #fff;
        }

        .ticket-label {
            font-size: 0.9em;
            color: #757575;
            margin-bottom: 2px;
        }

        .ticket-value {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 6px;
            word-break: break-word;
        }

        .ticket-details-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .ticket-details-table td {
            padding: 5px;
            vertical-align: top;
            width: 50%;
            word-break: break-word;
        }

        .barcode-section {
            text-align: center;
            margin: 15px 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .barcode-section img {
            max-width: 100%;
            height: auto;
        }

        .barcode-section p {
            margin: 5px 0;
            word-break: break-all;
            font-size: 10px;
        }

        .qr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
            width: 100%;
        }

        .qr-code {
            margin: 0 auto;
            display: block;
            max-width: 220px;
            max-height: 220px;
        }

        .barcode-placeholder {
            display: inline-block;
            width: 80%;
            height: 50px;
            background: #eee;
            border: 1px dashed #bdbdbd;
            border-radius: 4px;
            line-height: 50px;
            color: #bdbdbd;
            font-size: 1em;
        }

        .ticket-footer {
            background: #e3e3e3;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            padding: 10px 15px;
            font-size: 0.85em;
            color: #444;
            text-align: center;
            position: relative;
        }

        .timestamp {
            display: block;
            font-size: 0.85em;
            color: #888;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div class="ticket-header"
            style="display: flex; align-items: center; justify-content: center; text-align: center;">
            <span>Schiphol Orbital</span>
        </div>
        <div class="ticket-body">
            <div class="ticket-section">
                <div class="ticket-label">Passenger Name</div>
                <div class="ticket-value">{{ $booking->traveler->name }}</div>
            </div>
            <div class="ticket-section">
                <table class="ticket-details-table">
                    <tr>
                        <td>
                            <div class="ticket-label">Flight Number</div>
                            <div class="ticket-value">{{ $booking->flight->flight_number }}</div>
                        </td>
                        <td>
                            <div class="ticket-label">Destination</div>
                            <div class="ticket-value">{{ $booking->flight->destination }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ticket-label">Gate</div>
                            <div class="ticket-value">{{ 'B12' }}</div>
                        </td>
                        <td>
                            <div class="ticket-label">Seat</div>
                            <div class="ticket-value">{{ $booking->seat }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ticket-label">Departure</div>
                            <div class="ticket-value">
                                {{ Carbon::parse($booking->flight->departure_date)->format('d M Y') }}
                                at {{ Carbon::parse($booking->flight->departure_time)->format('H:i') }}
                            </div>
                        </td>
                        <td>
                            <div class="ticket-label">Boarding</div>
                            <div class="ticket-value">
                                {{ Carbon::parse($booking->flight->departure_date . ' ' . $booking->flight->departure_time)->subMinutes(45)->format('d M Y') }}
                                at
                                {{ Carbon::parse($booking->flight->departure_date . ' ' . $booking->flight->departure_time)->subMinutes(45)->format('H:i') }}
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="barcode-section">
                @if(!empty($booking) && !empty($booking->tracker))
                    @php
                        $dns1d = new \Milon\Barcode\DNS1D();
                        $dns2d = new \Milon\Barcode\DNS2D();
                    @endphp
                    <div style="text-align: center; max-width: 100%; overflow-x: auto;">
                        <div style="display: inline-block; max-width: 100%; overflow-x: auto;">
                            <div style="max-width: 100%; overflow-x: auto;">
                                {!! $dns1d->getBarcodeHTML($booking->tracker, 'C128', 1.5, 40) !!}
                            </div>
                        </div>
                        <hr>
                        <div style="margin: 10px auto; margin-left: 50px; display: flex; justify-content: center; align-items: center; width: 100%; text-align: center;">
                            <div style="max-width: 220px; max-height: 220px; overflow: hidden; margin: 0 auto;">
                                {!! $dns2d->getBarcodeHTML($booking->tracker, 'QRCODE', 4, 4) !!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="barcode-placeholder">[BARCODE]</div>
                @endif
            </div>
        </div>
        <div class="ticket-footer">
            <span>Please arrive 45 minutes before departure. Boarding closes 15 minutes prior to departure.</span>
            <span class="timestamp">
                {{ $generated_at ?? Carbon::now()->format('Y-m-d H:i') }}
            </span>
        </div>
    </div>
</body>

</html>