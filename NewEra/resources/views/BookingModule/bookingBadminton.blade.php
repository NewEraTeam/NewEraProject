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

        input[type="date"],
        select {
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

        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Details - Badminton</h2>
        <form id="booking-form">
            <!-- Date Input -->
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <!-- Time Dropdown -->
            <label for="time">Time:</label>
            <select id="time" name="time" required>
                <option value="" selected disabled>Select a time</option>
                <option value="8:00">8:00 AM</option>
                <option value="9:00">9:00 AM</option>
                <option value="10:00">10:00 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="13:00">1:00 PM</option>
                <option value="14:00">2:00 PM</option>
                <option value="15:00">3:00 PM</option>
                <option value="16:00">4:00 PM</option>
                <option value="17:00">5:00 PM</option>
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
            <input type="hidden" id="selected-courts" name="selected-courts">

            <!-- Submit Button -->
            <button type="submit">Next</button>
        </form>
    </div>

    <script>
        // Disable past times logic
        function disablePastTimes() {
            const dateInput = document.getElementById('date');
            const timeSelect = document.getElementById('time');
            const today = new Date();
            const selectedDate = new Date(dateInput.value);

            const options = timeSelect.options;

            // Reset all time options
            for (let i = 0; i < options.length; i++) {
                options[i].disabled = false;
            }

            if (selectedDate.toDateString() === today.toDateString()) {
                for (let i = 0; i < options.length; i++) {
                    const timeValue = options[i].value;
                    const timeHour = parseInt(timeValue.split(':')[0]);

                    if (timeHour <= today.getHours()) {
                        options[i].disabled = true;
                    }
                }
            }
        }

        // Set minimum date for the date picker
        const dateInput = document.getElementById('date');
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        dateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

        // Add event listener to date picker
        dateInput.addEventListener('change', disablePastTimes);

        // Toggle court button selection
        const courtButtons = document.querySelectorAll('.toggle-btn');
        const selectedCourtsInput = document.getElementById('selected-courts');

        courtButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('active');

                const selectedCourts = Array.from(courtButtons)
                    .filter((btn) => btn.classList.contains('active'))
                    .map((btn) => btn.getAttribute('data-court'));

                selectedCourtsInput.value = selectedCourts.join(',');
            });
        });
    </script>
</body>
</html>
