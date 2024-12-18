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

        option:disabled {
            color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Details - Swimming</h2>
        <form method="POST" action="{{ route('submitPayment') }}">
        @csrf

        <!-- Date Input -->
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <!-- Start Time Dropdown -->
        <label for="start-time">Start Time:</label>
        <select id="start-time">
            <option value="8">8:00 AM</option>
            <option value="9">9:00 AM</option>
            <option value="10">10:00 AM</option>
            <option value="11">11:00 AM</option>
            <option value="12">12:00 PM</option>
            <option value="13">1:00 PM</option>
            <option value="14">2:00 PM</option>
            <option value="15">3:00 PM</option>
            <option value="16">4:00 PM</option>
            <option value="17">5:00 PM</option>
            <option value="18">6:00 PM</option>
            <option value="19">7:00 PM</option>
        </select>

        <!-- End Time Dropdown -->
        <label for="end-time">End Time:</label>
        <select id="end-time">
            <option value="9">9:00 AM</option>
            <option value="10">10:00 AM</option>
            <option value="11">11:00 AM</option>
            <option value="12">12:00 PM</option>
            <option value="13">1:00 PM</option>
            <option value="14">2:00 PM</option>
            <option value="15">3:00 PM</option>
            <option value="16">4:00 PM</option>
            <option value="17">5:00 PM</option>
            <option value="18">6:00 PM</option>
            <option value="19">7:00 PM</option>
            <option value="20">8:00 PM</option>
        </select>

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

        <!-- Next Button -->
        <button type="submit" id="total-price">Total Price: RM 4.00</button>
        </form>
    </div>

    <script>
        const dateInput = document.getElementById('date');
        const startTimeSelect = document.getElementById('start-time');
        const endTimeSelect = document.getElementById('end-time');
        const today = new Date();

        // Set minimum date to today
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        dateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

        // Disable times that have passed
        function updateTimeOptions() {
            const selectedDate = new Date(dateInput.value);
            const currentTime = new Date();
            const isToday = selectedDate.toDateString() === currentTime.toDateString();

            // Enable all options first
            Array.from(startTimeSelect.options).forEach(option => option.disabled = false);
            Array.from(endTimeSelect.options).forEach(option => option.disabled = false);

            if (isToday) {
                const currentHour = currentTime.getHours();
                Array.from(startTimeSelect.options).forEach(option => {
                    if (parseInt(option.value) <= currentHour) {
                        option.disabled = true;
                    }
                });
                Array.from(endTimeSelect.options).forEach(option => {
                    if (parseInt(option.value) <= currentHour) {
                        option.disabled = true;
                    }
                });
            }
        }

        // Add event listeners
        dateInput.addEventListener('change', updateTimeOptions);
        window.addEventListener('load', () => {
            dateInput.value = `${yyyy}-${mm}-${dd}`;
            updateTimeOptions();
        });

        // Court button selection logic (not used anymore as price is fixed)
        const courtButtons = document.querySelectorAll('.toggle-btn');
        const totalPriceElement = document.getElementById('total-price');

        courtButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('active');

                // Remove price calculation logic, since price is fixed
                totalPriceElement.textContent = `Total Price: RM 4.00`;
            });
        });
    </script>
</body>
</html>
