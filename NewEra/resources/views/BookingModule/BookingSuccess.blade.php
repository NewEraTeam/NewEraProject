<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f9f4;
        }

        /* Box Styling */
        .success-box {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        /* Success Icon */
        .success-icon {
            color: #4caf50;
            font-size: 80px; /* Increased size */
            margin-bottom: 15px;
        }

        /* Content Styling */
        .success-box h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 15px;
        }

        .success-box p {
            font-size: 16px;
            color: #555555;
            margin: 5px 0;
        }

        /* Button Styling */
        .mainpage-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #4caf50;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .mainpage-button:hover {
            background-color: #43a047;
        }
    </style>
</head>
<body>
    <div class="success-box">
        <!-- Larger Success Icon -->
        <div class="success-icon">✔</div>

        <!-- Content -->
        <h1>Payment Successful!</h1>
        <p>Thank you for your booking, <strong>{{ $booking->matric_number }}</strong>.</p>
        <p>Your booking ID is: <strong>{{ $booking->booking_id }}</strong></p>
        <p>Payment Status: <strong>{{ $booking->payment_status }}</strong></p>

        <ul type="hidden">
            <li ><strong>Booking ID:</strong> {{ $emailData['booking_id'] }}</li>
            <li ><strong>Matric Number:</strong> {{ $emailData['matric_number'] }}</li>
            <li ><strong>Booking Type:</strong> {{ $emailData['booking_type'] }}</li>
            @if($emailData['start_date'])
                <li ><strong>Start Date:</strong> {{ $emailData['start_date'] }}</li>
                <li ><strong>End Date:</strong> {{ $emailData['end_date'] }}</li>
            @endif
            @if($emailData['start_month'])
                <li ><strong>Start Month:</strong> {{ $emailData['start_month'] }}</li>
                <li ><strong>End Month:</strong> {{ $emailData['end_month'] }}</li>
            @endif
            <li ><strong>Total Price:</strong> RM{{ $emailData['total_price'] }}</li>
            <li ><strong>Payment Status:</strong> {{ $emailData['payment_status'] }}</li>
        </ul>

        <!-- Button to Main Page -->
        <a href="{{ route('view-mainpage') }}" class="mainpage-button">Go to Main Page</a>
    </div>
</body>
</html>
