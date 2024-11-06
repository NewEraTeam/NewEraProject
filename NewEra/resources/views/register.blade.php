<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTM SPORT BOOKING SYSTEM - Register</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            color: white;
            position: relative;
            overflow: hidden;
            background: url('path/to/your/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .background-blur {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(8px);
            z-index: -1;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .register-container h2 {
            margin-bottom: 1rem;
            color: black;
        }

        .register-container input, .register-container select {
            width: 100%;
            padding: 0.5rem;
            margin: 0.5rem 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .register-container button {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 1rem;
        }

        .register-btn {
            background-color: #4CAF50;
            color: white;
        }

        .login-return-btn {
            background-color: #2196F3;
            color: white;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="background-blur"></div>

    <div class="register-container">
        <h2>New User Registration</h2>

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="matric_number" placeholder="Matric Number" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <select name="role" required>
                <option value="" disabled selected>Choose Role</option>
                <option value="Student">Student</option>
                <option value="Staff">Staff</option>
            </select>
            <button type="submit" class="register-btn">Register</button>
        </form>

        <form action="{{ route('login.page') }}" method="GET">
            <button type="submit" class="login-return-btn">Back to Login</button>
        </form>
    </div>

    <script>
        document.querySelector('form[action="{{ route('register.submit') }}"]').addEventListener('submit', function(event) {
            event.preventDefault();
            // Simple popup message for demo purposes
            alert("Your information has been successfully registered.");
            this.submit();
        });
    </script>
</body>
</html>
