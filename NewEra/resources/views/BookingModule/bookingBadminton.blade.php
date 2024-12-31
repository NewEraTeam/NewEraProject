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

        #total-price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color:#ffffff;
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
        <h2>Booking Details - Badminton</h2>
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <!-- Matric Number -->
            <p style="text-align: left;"><strong>Matric Number:</strong> {{ Auth::user()->matric_number }}</p>
            <input type="hidden" name="matric_number" value="{{ Auth::user()->matric_number }}">

            <!-- Date Input -->
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <!-- Start Time Dropdown -->
            <label for="start-time">Start Time:</label>
            <select id="start-time" name="start_time" required>
                @for ($hour = 8; $hour <= 19; $hour++)
                    <option value="{{ sprintf('%02d:00', $hour) }}">{{ $hour }}:00 {{ $hour < 12 ? 'AM' : 'PM' }}</option>
                @endfor
            </select>

            <!-- End Time Dropdown -->
            <label for="end-time">End Time:</label>
            <select id="end-time" name="end_time" required>
                @for ($hour = 9; $hour <= 20; $hour++)
                    <option value="{{ sprintf('%02d:00', $hour) }}">{{ $hour }}:00 {{ $hour < 12 ? 'AM' : 'PM' }}</option>
                @endfor
            </select>

            <!-- Court Selection -->
            <label for="court">Court:</label>
            <div class="court-buttons">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="toggle-btn" data-court="Court {{ $i }}">Court {{ $i }}</div>
                @endfor
            </div>
            <input type="hidden" name="court" id="selected-court">

            <!-- Total Price -->
            <input type="hidden" name="total_price" id="total-price-hidden">
            <button type="submit" id="total-price">Total Price: RM 0.00</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>

document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('selected-court').value = this.dataset.court;
        });
    });

        const dateInput = document.getElementById('date');
        const startTimeSelect = document.getElementById('start-time');
        const endTimeSelect = document.getElementById('end-time');
        const totalPriceElement = document.getElementById('total-price');
        const totalPriceInput = document.getElementById('total-price-hidden');
        const courtsInput = document.getElementById('selected-courts');
        const courtButtons = document.querySelectorAll('.toggle-btn');
        const pricePerCourtPerHour = 5.0;

        // Set minimum date to today
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        dateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

        // Calculate total price
        function calculateTotalPrice() {
            const selectedCourts = Array.from(document.querySelectorAll('.toggle-btn.active'));
            const selectedStartTime = parseInt(startTimeSelect.value);
            const selectedEndTime = parseInt(endTimeSelect.value);
            const duration = selectedEndTime - selectedStartTime;
            const totalPrice = selectedCourts.length * pricePerCourtPerHour * duration;

            // Update price display and hidden input
            totalPriceElement.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;
            totalPriceInput.value = totalPrice.toFixed(2);

            // Update selected courts input
            const courts = selectedCourts.map(court => court.getAttribute('data-court'));
            courtsInput.value = courts.join(',');
        }

        // Event listeners
        courtButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('active');
                calculateTotalPrice();
            });
        });

        startTimeSelect.addEventListener('change', calculateTotalPrice);
        endTimeSelect.addEventListener('change', calculateTotalPrice);

        // Stripe Payment
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.querySelector('form');
        const cardErrors = document.getElementById('card-errors');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                cardErrors.textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method_id');
                hiddenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
</body>
</html>
