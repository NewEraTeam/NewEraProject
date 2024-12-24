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
                color: #e6e6e6;
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
            <form method="POST" action="{{ route('submitPayment') }}">
            @csrf
            <input type="hidden" name="start_time" id="hidden-start-time">
            <input type="hidden" name="end_time" id="hidden-end-time">
            <input type="hidden" name="court[]" id="hidden-court">
            <input type="hidden" name="total_price" id="hidden-total-price">

            <!-- Date Input -->
            <p style="text-align: left;"><strong>Matric Number:</strong> {{ Auth::user()->matric_number }}</p>
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

            <!-- Payment Section -->
            <hr>
            <h3 style="text-align: center;">Payment Section</h3>
            <label for="card-element">Enter your card details:</label>
            <div id="card-element">
                <!-- Stripe Element will be inserted here -->
            </div>
            <div id="card-element"></div>
            <div id="card-errors" role="alert" style="color: red; margin-top: 10px;"></div>

            <!-- Next Button -->
            <button type="submit" id="total-price" >Total Price: RM 0.00</button>
            </form>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
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

            // Court button selection logic
            const courtButtons = document.querySelectorAll('.toggle-btn');
            const totalPriceElement = document.getElementById('total-price');
            const pricePerCourtPerHour = 5.0;

            courtButtons.forEach((btn) => {
                btn.addEventListener('click', () => {
                    btn.classList.toggle('active');

                    // Get the selected courts and times
                    const selectedCourts = document.querySelectorAll('.toggle-btn.active');
                    const selectedStartTime = parseInt(startTimeSelect.value);
                    const selectedEndTime = parseInt(endTimeSelect.value);

                    // Calculate the duration
                    const duration = selectedEndTime - selectedStartTime;
                    const totalPrice = selectedCourts.length * pricePerCourtPerHour * duration;

                    totalPriceElement.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;
                    courtButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
            btn.classList.toggle('active');

            // Get the selected courts and times
            const selectedCourts = document.querySelectorAll('.toggle-btn.active');
            const selectedStartTime = parseInt(startTimeSelect.value);
            const selectedEndTime = parseInt(endTimeSelect.value);

            // Calculate the duration
            const duration = selectedEndTime - selectedStartTime;
            const totalPrice = selectedCourts.length * pricePerCourtPerHour * duration;

            // Update the total price display
            totalPriceElement.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;

            // Update the hidden input field for total_price
            const totalPriceInput = document.querySelector('input[name="total_price"]');
            if (totalPriceInput) {
                totalPriceInput.value = totalPrice.toFixed(2);
                courtButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
            btn.classList.toggle('active');

            // Get the selected courts and times
            const selectedCourts = document.querySelectorAll('.toggle-btn.active');
            const selectedStartTime = parseInt(startTimeSelect.value);
            const selectedEndTime = parseInt(endTimeSelect.value);

            // Calculate the duration
            const duration = selectedEndTime - selectedStartTime;
            const totalPrice = selectedCourts.length * pricePerCourtPerHour * duration;

            // Update the total price display
            totalPriceElement.textContent = `Total Price: RM ${totalPrice.toFixed(2)}`;

            // Update the hidden input field for total_price
            const totalPriceInput = document.querySelector('input[name="total_price"]');
            if (totalPriceInput) {
                totalPriceInput.value = totalPrice.toFixed(2);
            }
        });
    });

            }
        });
    });

                });
            });

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
                    // Submit the payment method ID along with the form
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'payment_method_id');
                    hiddenInput.setAttribute('value', paymentMethod.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });

            form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const selectedCourts = Array.from(document.querySelectorAll('.toggle-btn.active')).map((btn) =>
            btn.getAttribute('data-court')
        );
        const totalPrice = calculateTotalPrice(selectedCourts.length);
        document.getElementById('hidden-start-time').value = startTimeSelect.value;
        document.getElementById('hidden-end-time').value = endTimeSelect.value;
        document.getElementById('hidden-court').value = JSON.stringify(selectedCourts);
        document.getElementById('hidden-total-price').value = totalPrice;

        // Proceed with Stripe Payment
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

    function calculateTotalPrice(numCourts) {
        const duration = parseInt(endTimeSelect.value) - parseInt(startTimeSelect.value);
        return numCourts * duration * pricePerCourtPerHour;
    }

        </script>
    </body>
    </html>

