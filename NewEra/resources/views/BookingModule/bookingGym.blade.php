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
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Details - Gym</h2>
        <form method="POST" action="{{ route('bookings.gym.store') }}">
            @csrf
            <p style="text-align: left;"><strong>Matric Number:</strong> {{ Auth::user()->matric_number }}</p>
            <input type="hidden" name="matric_number" value="{{ Auth::user()->matric_number }}">
            <input type="hidden" name="email" value="{{ Auth::user()->email }}">

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

            <input type="hidden" name="total_price" id="total-price-hidden">
            <button type="submit" id="total-price">Total Price: RM0.00</button>
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
        const totalPriceInput = document.getElementById('total-price-hidden');
        const totalPriceElement = document.getElementById("total-price");

        const membershipPricePerMonth = 40.00;

        const today = new Date();
        const todayStr = today.toISOString().split("T")[0];

        startDateInput.setAttribute("min", todayStr);

        startDateInput.addEventListener("change", () => {
            const startDate = new Date(startDateInput.value);
            const maxEndDate = new Date(startDate);
            maxEndDate.setDate(startDate.getDate() + 7);

            endDateInput.setAttribute("min", startDateInput.value);
            endDateInput.setAttribute("max", maxEndDate.toISOString().split("T")[0]);
        });

        const calculateDailyPrice = () => {
            const basePrice = 10.00; // Constant base price
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (endDate > startDate) {
                const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                const totalPrice = basePrice + (days * 5); // Add base price to daily rate
                totalPriceInput.value = totalPrice.toFixed(2); // Update hidden input
                totalPriceElement.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;
            } else {
                totalPriceInput.value = totalPrice.toFixed(2); // Update hidden input
                totalPriceElement.textContent = `Total Price: RM ${basePrice.toFixed(2)}`; // Show base price if invalid date range
            }
        };

        startDateInput.addEventListener("change", calculateDailyPrice);
        endDateInput.addEventListener("change", calculateDailyPrice);

        bookingType.addEventListener("change", () => {
            if (bookingType.value === "daily") {
                dailySection.style.display = "block";
                membershipSection.style.display = "none";
                totalPriceElement.textContent = "Total Price: RM 0.00";
            } else if (bookingType.value === "membership") {
                dailySection.style.display = "none";
                membershipSection.style.display = "block";
                totalPriceElement.textContent = "Total Price: RM 0.00";
                populateMonthOptions();
            }
        });

        const currentMonth = today.getMonth() + 1;
        const currentYear = today.getFullYear();
        const monthNames = [
            "January", "February", "March", "April", "May",
            "June", "July", "August", "September", "October",
            "November", "December"
        ];

        const populateMonthOptions = () => {
            startMonthSelect.innerHTML = '<option value="" disabled selected>Select Start Month</option>';
            endMonthSelect.innerHTML = '<option value="" disabled selected>Select End Month</option>';

            for (let i = currentMonth; i <= 12; i++) {
                const monthName = `${monthNames[i - 1]} ${currentYear}`;
                startMonthSelect.innerHTML += `<option value="${i}">${monthName}</option>`;
            }

            startMonthSelect.addEventListener("change", () => {
                const selectedStartMonth = parseInt(startMonthSelect.value);
                endMonthSelect.innerHTML = '<option value="" disabled selected>Select End Month</option>';

                for (let j = selectedStartMonth; j <= Math.min(selectedStartMonth + 2, 12); j++) {
                    const monthName = `${monthNames[j - 1]} ${currentYear}`;
                    endMonthSelect.innerHTML += `<option value="${j}">${monthName}</option>`;
                }

                calculateMembershipPrice();
            });

            endMonthSelect.addEventListener("change", calculateMembershipPrice);
        };

        const calculateMembershipPrice = () => {
            const basePrice = 20.00; // Constant base price
            const startMonth = parseInt(startMonthSelect.value);
            const endMonth = parseInt(endMonthSelect.value);
            const membershipPricePerMonth = 15.00; // Price per month

            if (startMonth && endMonth && endMonth >= startMonth) {
                const months = endMonth - startMonth + 1;
                const totalPrice = basePrice + (months * membershipPricePerMonth); // Add base price to monthly rate
                totalPriceInput.value = totalPrice.toFixed(2); // Update hidden input
                totalPriceElement.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;
            } else {
                totalPriceInput.value = totalPrice.toFixed(2); // Update hidden input
                totalPriceElement.textContent = `Total Price: RM ${basePrice.toFixed(2)}`; // Show base price if invalid range
            }
        };

    </script>
</body>
</html>
