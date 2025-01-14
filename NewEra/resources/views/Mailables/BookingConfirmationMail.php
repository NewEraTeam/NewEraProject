<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .success-icon {
            font-size: 50px;
            color: green;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            width: 80px;
        }


        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header h1 {
            font-size: 24px;
            margin: 0;
            color: #007bff;
        }
        .email-body p {
            margin: 10px 0;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Your Booking Has Been Confirmed!</h1>
        </div>
        <div class="success-icon">✔</div>
        <div class="email-body">
            <p> <span class="highlight">Thank you for your booking</span>.</p>
            <p>Please attend to the counter to confirm your attendance</p>
            <p>Any missed booking will <span class="highlight"> NOT REFUNDED </span></p>
            <!-- <p>Your booking ID: <span class="highlight">{{ $bookingId }}</span></p>
            <p>Total Price: <span class="highlight">RM{{ $totalPrice }}</span></p>
            <p>Payment Status: <span class="highlight">{{ $paymentStatus }}</span></p> -->
        </div>
        <div class="footer">
            <p>If you have any questions, feel free to contact us at 07-553 6879.</p>
        </div>
    </div>
</body>
</html>
