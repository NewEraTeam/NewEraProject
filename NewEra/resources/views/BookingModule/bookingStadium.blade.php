<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Stadium</title>
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

        .add-ons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 15px 0;
        }

        .toggle-button {
            border: 1px solid #007bff;
            background-color: white;
            color: #007bff;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-button.active {
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
        <h2>Booking Details - Stadium</h2>
        <form method="POST" action="{{ route('submitPayment') }}">
        @csrf

        <!-- Start Date -->
        <label for="start-date">Start Date:</label>
        <input type="date" id="start-date" name="start_date" required>

        <!-- End Date -->
        <label for="end-date">End Date:</label>
        <input type="date" id="end-date" name="end_date" required>

        <!-- Add-Ons -->
        <label for="add-ons">Add-On:</label>
        <div class="add-ons" id="add-ons">
            <div class="toggle-button" data-price="20" data-id="pa-system">PA System - RM20</div>
            <div class="toggle-button" data-price="30" data-id="stadium-lights">Stadium Lights - RM30</div>
            <div class="toggle-button" data-price="20" data-id="leaderboard">Leaderboard - RM20</div>
            <div class="toggle-button" data-price="10" data-id="podium">Podium - RM10</div>
        </div>

        <hr style="margin: 20px 0; border: 1px solid #ccc;">

        <!-- Personal Details -->
        <div class="personal-details" style="text-align: left;">
            <h3 style="text-align: center;">Your Personal Details</h3>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Matric Number:</strong> {{ Auth::user()->matric_number }}</p>
            <p><strong>Phone Number:</strong> {{ Auth::user()->phone_number }}</p>
            <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="total-price">Total Price: RM0.00</button>
        </form>
    </div>

    <script>
        const startDateInput = document.getElementById('start-date');
        const endDateInput = document.getElementById('end-date');
        const toggleButtons = document.querySelectorAll('.toggle-button');
        const totalPriceElement = document.getElementById('total-price');
        const baseRate = 50; // Base rate per day

        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        startDateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);
        endDateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

        startDateInput.addEventListener('change', () => {
            const startDate = new Date(startDateInput.value);
            const minEndDate = new Date(startDate);
            minEndDate.setDate(minEndDate.getDate() + 1);

            const yyyy = minEndDate.getFullYear();
            const mm = String(minEndDate.getMonth() + 1).padStart(2, '0');
            const dd = String(minEndDate.getDate()).padStart(2, '0');
            endDateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);
            endDateInput.value = ''; // Clear invalid end date
            calculateTotalPrice();
        });

        endDateInput.addEventListener('change', calculateTotalPrice);

        toggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.classList.toggle('active');
                calculateTotalPrice();
            });
        });

        function calculateTotalPrice() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const addOnPrices = Array.from(toggleButtons)
                .filter(button => button.classList.contains('active'))
                .map(button => parseFloat(button.dataset.price))
                .reduce((sum, price) => sum + price, 0);

            if (startDate && endDate && endDate > startDate) {
                const duration = (endDate - startDate) / (1000 * 60 * 60 * 24); // Calculate days
                const totalPrice = duration * baseRate + addOnPrices;
                totalPriceElement.textContent = `Total Price: RM${totalPrice.toFixed(2)}`;
            } else {
                totalPriceElement.textContent = 'Total Price: RM0.00';
            }
        }
    </script>
</body>
</html>
