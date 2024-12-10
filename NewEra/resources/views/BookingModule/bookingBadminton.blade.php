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
            background-color: #f9f9f9;
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
            font-weight: bold;
        }

        .step.active {
            background-color: #007bff;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input, select, button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        select option[disabled] {
            color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="progress-bar">
            <div class="step active">1</div>
            <div class="step">2</div>
            <div class="step">3</div>
        </div>
        <h2>Booking Details - Badminton</h2>
        <form method="POST" action="{{ route('submitBookingBadminton') }}">
            @csrf
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <select id="time" name="time" required>
                <option value="">Select Time</option>
                <option value="07:00">7:00 AM</option>
                <option value="08:00">8:00 AM</option>
                <option value="09:00">9:00 AM</option>
                <option value="10:00">10:00 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="13:00">1:00 PM</option>
                <option value="14:00">2:00 PM</option>
                <option value="15:00">3:00 PM</option>
                <option value="16:00">4:00 PM</option>
                <option value="17:00">5:00 PM</option>
                <option value="18:00">6:00 PM</option>
                <option value="19:00">7:00 PM</option>
            </select>

            <label for="court">Court:</label>
            <select id="court" name="court" required>
                <option value="">Select Court</option>
                <option value="1">Court 1</option>
                <option value="2">Court 2</option>
                <option value="3">Court 3</option>
                <option value="4">Court 4</option>
                <option value="5">Court 5</option>
                <option value="6">Court 6</option>
            </select>
            <button type="submit">Next</button>
        </form>
    </div>

    <script>
        // Disable past dates in the date picker
        const dateInput = document.getElementById('date');
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const minDate = `${yyyy}-${mm}-${dd}`;
        dateInput.setAttribute('min', minDate);

        // Disable past times based on the current time
        const timeSelect = document.getElementById('time');
        const currentTime = today.getHours();

        const disablePastTimes = () => {
            const options = timeSelect.options;
            for (let i = 0; i < options.length; i++) {
                const timeValue = options[i].value;
                const timeHour = parseInt(timeValue.split(':')[0]);

                // Disable times that are before the current hour
                if (timeHour < currentTime) {
                    options[i].disabled = true;
                }
            }
        };

        // Run the function when the page loads
        disablePastTimes();

        // Re-enable all times when the date changes to a future date
        dateInput.addEventListener('change', (e) => {
            const selectedDate = new Date(dateInput.value);
            if (selectedDate > today) {
                const options = timeSelect.options;
                for (let i = 0; i < options.length; i++) {
                    options[i].disabled = false;
                }
            } else {
                disablePastTimes();
            }
        });
    </script>
</body>
</html>
