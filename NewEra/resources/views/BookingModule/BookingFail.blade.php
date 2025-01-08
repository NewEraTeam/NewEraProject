<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
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
            background-color: #fff5f5;
        }

        /* Box Styling */
        .error-box {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        /* Error Icon */
        .error-icon {
            color: #f44336;
            font-size: 80px; /* Increased size */
            margin-bottom: 15px;
        }

        /* Content Styling */
        .error-box h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 15px;
        }

        .error-box p {
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
            background-color: #f44336;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .retry-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <!-- Larger Error Icon -->
        <div class="error-icon">✖</div>

        <!-- Content -->
        <h1>Payment Failed!</h1>
        <p>We encountered an issue with your booking, <strong>{{ $booking->matric_number }}</strong>.</p>
        <p>Please check your payment details and try again.</p>
        <p>Booking ID: <strong>{{ $booking->booking_id }}</strong></p>

        <!-- Button to Retry -->
        <a href="{{ route('view-mainpage') }}" class="mainpage-button">Go to Main Page</a>
    </div>
</body>
</html>
