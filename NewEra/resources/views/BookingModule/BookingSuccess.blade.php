<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Successful!</h1>
    <p>Thank you for your booking, {{ $booking->matric_number }}.</p>
    <p>Your booking ID is: {{ $booking->booking_id }}</p>
    <p>Payment Status: {{ $booking->payment_status }}</p>
</body>
</html>
