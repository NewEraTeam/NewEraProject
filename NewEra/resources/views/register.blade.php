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
        }

        /* Background Image with Blur */
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyYwz565mvoGTdviUr9mhH2oh2XLEzi4pRyg&s');
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            z-index: -1;
        }

        /* Register Form Container */
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

        /* Error message styling */
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            text-align: left;
        }

        /* Success message styling */
        .alert-success {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Background Image and Blur Effect -->
    <div class="background-image"></div>

    <!-- Register Container -->
    <div class="register-container">
        <!-- Success message here -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>New User Registration</h2>

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="email" name="email" placeholder="Email" required>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="text" name="username" placeholder="Username" required>
            @error('username')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Re-enter Password" required>
            @error('password_confirmation')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="text" name="matric_number" placeholder="Matric Number" required>
            @error('matric_number')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="text" name="phone_number" placeholder="Phone Number" required>
            @error('phone_number')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <select name="role" required>
                <option value="" disabled selected>Choose Role</option>
                <option value="Student">Student</option>
                <option value="Staff">Staff</option>
            </select>
            @error('role')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <button type="submit" class="register-btn">Register</button>
        </form>

        <form action="{{ route('login.page') }}" method="GET">
            <button type="submit" class="login-return-btn">Back to Login</button>
        </form>
    </div>
</body>
</html>
