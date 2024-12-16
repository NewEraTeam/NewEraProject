<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Badminton</title>
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

        .court-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 15px 0;
        }

        .toggle-btn {
            width: 30%;
            margin-bottom: 10px;
            padding: 8px 0;
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

        /* Price display */
        #total-price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
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
        <h2>Booking Details - Badminton</h2>

        <!-- Date Input -->
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <!-- Time Dropdown -->
        <label for="time">Time:</label>
        <select id="time">
            <option>9:00 AM</option>
            <option>11:00 AM</option>
            <option>2:00 PM</option>
            <option>4:00 PM</option>
        </select>

        <!-- Court Selection -->
        <label for="court">Court:</label>
        <div class="court-buttons">
            <div class="toggle-btn" data-court="Court 1">Court 1</div>
            <div class="toggle-btn" data-court="Court 2">Court 2</div>
            <div class="toggle-btn" data-court="Court 3">Court 3</div>
            <div class="toggle-btn" data-court="Court 4">Court 4</div>
            <div class="toggle-btn" data-court="Court 5">Court 5</div>
            <div class="toggle-btn" data-court="Court 6">Court 6</div>
        </div>

        <!-- Total Price Section -->
        <div id="total-price">Total Price: RM 0.00</div>

        <!-- Next Button -->
        <button type="button">Next</button>
    </div>

    <script>
        // Set minimum date for the date picker
        const dateInput = document.getElementById('date');
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        dateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

        // Court button selection logic and total price calculation
        const courtButtons = document.querySelectorAll('.toggle-btn');
        const totalPriceElement = document.getElementById('total-price');
        const pricePerCourt = 5.0;

        courtButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                // Toggle active class
                btn.classList.toggle('active');

                // Count selected courts
                const selectedCourts = document.querySelectorAll('.toggle-btn.active');
                const totalPrice = selectedCourts.length * pricePerCourt;

                // Update total price display
                totalPriceElement.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;
            });
        });
    </script>
</body>
</html>
