<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Gym</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        #total-price {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color : #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Details - Gym</h2>
        <form method="POST" action="{{ route('submitPayment') }}">
            @csrf

            <!-- Booking Type -->
            <label for="booking-type">Booking Type:</label>
            <select id="booking-type" name="booking_type" required>
                <option value="" disabled selected>Select Booking Type</option>
                <option value="daily">Daily</option>
                <option value="membership">Membership</option>
            </select>

            <!-- Daily Booking -->
            <div id="daily-section" style="display: none;">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start_date">

                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end_date">
            </div>

            <!-- Membership Booking -->
            <div id="membership-section" style="display: none;">
                <label for="start-month">Start Month:</label>
                <select id="start-month" name="start_month"></select>

                <label for="end-month">End Month:</label>
                <select id="end-month" name="end_month"></select>
            </div>

            <hr style="margin: 20px 0; border: 1px solid #ccc;">

            <!-- Personal Details Fetched from Authenticated User -->
            <div class="personal-details" style="text-align: left;">
                <h3 style="text-align: center;">Your Personal Details</h3>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Matric Number:</strong> {{ Auth::user()->matric_number }}</p>
                <p><strong>Phone Number:</strong> {{ Auth::user()->phone_number }}</p>
                <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="total-price">Total Price: RM 0.00</button>
        </form>
    </div>

    <script>
        const bookingType = document.getElementById("booking-type");
        const dailySection = document.getElementById("daily-section");
        const membershipSection = document.getElementById("membership-section");
        const startDateInput = document.getElementById("start-date");
        const endDateInput = document.getElementById("end-date");
        const startMonthSelect = document.getElementById("start-month");
        const endMonthSelect = document.getElementById("end-month");
        const totalPriceElement = document.getElementById("total-price");

        // Get today's date
        const today = new Date();
        const currentMonth = today.getMonth() + 1;
        const currentYear = today.getFullYear();

        // Format month names
        const monthNames = [
            "January", "February", "March", "April", "May",
            "June", "July", "August", "September", "October",
            "November", "December"
        ];

        // Populate start and end months for membership booking
        const populateMonthOptions = () => {
            startMonthSelect.innerHTML = '<option value="" disabled selected>Select Start Month</option>';
            endMonthSelect.innerHTML = '<option value="" disabled selected>Select End Month</option>';

            // Start month (next month only)
            for (let i = currentMonth + 1; i <= 12; i++) {
                const monthName = `${monthNames[i - 1]} ${currentYear}`;
                startMonthSelect.innerHTML += `<option value="${i}">${monthName}</option>`;
            }

            // End month dynamically updated based on start month
            startMonthSelect.addEventListener("change", () => {
                const selectedStartMonth = parseInt(startMonthSelect.value);
                endMonthSelect.innerHTML = '<option value="" disabled selected>Select End Month</option>';

                for (let j = selectedStartMonth + 1; j <= Math.min(selectedStartMonth + 3, 12); j++) {
                    const monthName = `${monthNames[j - 1]} ${currentYear}`;
                    endMonthSelect.innerHTML += `<option value="${j}">${monthName}</option>`;
                }
            });
        };

        // Handle booking type change
        bookingType.addEventListener("change", () => {
            if (bookingType.value === "daily") {
                dailySection.style.display = "block";
                membershipSection.style.display = "none";
                totalPriceElement.textContent = "Total Price: RM 0.00";
            } else if (bookingType.value === "membership") {
                dailySection.style.display = "none";
                membershipSection.style.display = "block";
                populateMonthOptions();
                totalPriceElement.textContent = "Total Price: RM 0.00";
            }
        });

        // Calculate total price for membership booking
        const validateMembershipBooking = () => {
            const startMonth = parseInt(startMonthSelect.value);
            const endMonth = parseInt(endMonthSelect.value);

            if (endMonth <= startMonth || isNaN(endMonth)) {
                endMonthSelect.setCustomValidity("End month must be after the start month.");
            } else if (endMonth - startMonth > 3) {
                endMonthSelect.setCustomValidity("You can only book up to 3 months.");
            } else {
                endMonthSelect.setCustomValidity("");
            }

            const months = endMonth - startMonth;
            if (months > 0 && months <= 3) {
                totalPriceElement.textContent = `Total Price: RM ${(months * 70).toFixed(2)}`;
            } else {
                totalPriceElement.textContent = "Total Price: RM 0.00";
            }
        };

        startMonthSelect.addEventListener("change", validateMembershipBooking);
        endMonthSelect.addEventListener("change", validateMembershipBooking);
    </script>
</body>
</html>
