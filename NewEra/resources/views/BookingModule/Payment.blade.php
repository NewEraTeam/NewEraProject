<!-- resources/views/payment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .payment-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 30px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .summary {
            text-align: left;
            margin-bottom: 20px;
        }
        .summary div {
            margin: 5px 0;
        }
        .summary span {
            font-weight: bold;
        }
        .card-element {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        #card-errors {
            color: red;
            margin-top: 10px;
        }
        .customer-info input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="payment-container">
        <h2>Complete Your Payment</h2>

        <!-- Order Summary -->
        <div class="summary">
            <div><span>Order Number:</span> #12345</div>
            <div><span>Total:</span> $50.00</div>
        </div>

        <!-- Customer Information (Optional) -->
        <div class="customer-info">
            <input type="text" id="customer-name" placeholder="Enter your name" required>
            <input type="email" id="customer-email" placeholder="Enter your email" required>
        </div>

        <!-- Stripe Payment Form -->
        <form id="payment-form">
            <div id="card-element" class="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>

            <button type="submit" class="btn-submit">Submit Payment</button>
        </form>
    </div>

    <script>
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");  // Your Stripe Publishable Key
        var elements = stripe.elements();
        var card = elements.create("card");
        card.mount("#card-element");

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            // Gather customer details
            const customerName = document.getElementById('customer-name').value;
            const customerEmail = document.getElementById('customer-email').value;

            const {token, error} = await stripe.createToken(card);

            if (error) {
                // Display error.message
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // Send token and customer details to your server to process payment
                fetch('/payment', {
                    method: 'POST',
                    body: JSON.stringify({
                        payment_method_id: token.id,
                        customer_name: customerName,
                        customer_email: customerEmail
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.client_secret) {
                        alert('Payment Successful!');
                    } else {
                        alert('Payment Failed!');
                    }
                })
                .catch(error => console.log('Error:', error));
            }
        });
    </script>

</body>
</html>
