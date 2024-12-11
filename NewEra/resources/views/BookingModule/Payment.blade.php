<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: lightgray;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .step.active {
            background-color: #007bff;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input, button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="progress-bar">
            <div class="step active">1</div>
            <div class="step active">2</div>
            <div class="step active">3</div>
        </div>
        <h2>Payment</h2>
        <form action="/booking/payment" method="POST">
            <input type="hidden" name="_token" value="PLACE_CSRF_TOKEN_HERE">
            <label for="card-details">Enter Card Details:</label>
            <input type="text" name="card_number" required placeholder="Card Number">
            <input type="text" name="expiry_date" required placeholder="MM/YY">
            <input type="text" name="cvc" required placeholder="CVC">

            <form action="/booking/payment" method="POST">
                @csrf
                <!-- Existing form fields -->
                <button type="submit">Pay</button>
            </form>
        </form>
    </div>
</body>
</html>
