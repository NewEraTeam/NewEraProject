<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Swimming</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            text-align: left;
        }

        input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .toggle-btn {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 2px solid #007bff;
            color: #007bff;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            text-align: center;
            transition: background 0.3s, color 0.3s;
        }

        .toggle-btn.active {
            background-color: #007bff;
            color: white;
        }

        #total-price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #ffffff;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Details - Swimming</h2>
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <p style="text-align: left;"><strong>Matric Number:</strong> {{ Auth::user()->matric_number }}</p>
            <input type="hidden" name="matric_number" value="{{ Auth::user()->matric_number }}">

            <!-- Date Input -->
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <!-- Session Selection -->
            <label for="session">Session:</label>
            <select id="session" name="session" required>
                <option value="Morning">Morning (8:00 AM - 12:00 PM)</option>
                <option value="Afternoon">Afternoon (2:30 PM - 6:30 PM)</option>
            </select>

            <!-- Rent Swimming Cap -->
            <label for="rent-swimming-cap">Rent Swimming Cap:</label>
            <select id="rent-swimming-cap" name="rent_swimming_cap" required>
                <option value="No">No</option>
                <option value="Yes">Yes (Additional RM2.00)</option>
            </select>

            <!-- Submit Button -->
            <input type="hidden" name="total_price" id="total-price-hidden">
            <button type="submit" id="total-price">Total Price: RM 0.00</button>
        </form>
    </div>

    <script>
        const dateInput = document.getElementById('date');
        const sessionSelect = document.getElementById('session');
        const rentCapSelect = document.getElementById('rent-swimming-cap');
        const totalPriceInput = document.getElementById('total-price-hidden');
        const totalPriceDisplay = document.getElementById('total-price');
        const today = new Date();

        // Set minimum date to today
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        dateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

        // Price Calculation
        function calculateTotalPrice() {
            let totalPrice = 4.00; // Base price for session
            if (rentCapSelect.value === "Yes") {
                totalPrice += 2.00; // Add price for swimming cap rental
            }
            totalPriceInput.value = totalPrice.toFixed(2); // Update hidden input
            totalPriceDisplay.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;
        }

        // Event Listeners
        rentCapSelect.addEventListener('change', calculateTotalPrice);
        sessionSelect.addEventListener('change', calculateTotalPrice);

        // Initialize price
        calculateTotalPrice();
    </script>
</body>
</html>
