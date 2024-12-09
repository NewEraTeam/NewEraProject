<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details</title>
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

        input, button {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="progress-bar">
            <div class="step active">1</div>
            <div class="step active">2</div>
            <div class="step">3</div>
        </div>
        <h2>Personal Details</h2>
        <form method="POST" action="/booking/personal-details">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="matric_number">Matric Number:</label>
            <input type="text" id="matric_number" name="matric_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <form method="POST" action="/booking/personal-details">
                @csrf
                <!-- Existing form fields -->
                <button type="submit">Next</button>
            </form>
        </form>
    </div>
</body>
</html>
