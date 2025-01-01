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
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
                        url('{{ asset("ALLIMAGES/LOGIN.png") }}');
            background-size: cover;
            background-position: center;
            z-index: -1;
            filter: blur(2px);
        }

        .title {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            margin-top: 8rem;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in;
            position: relative;
            z-index: 1;
        }

        .register-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            backdrop-filter: blur(10px);
            animation: slideUpCenter 0.5s ease-out;
        }

        @keyframes slideUpCenter {
            from {
                opacity: 0;
                transform: translate(-50%, calc(-50% + 20px));
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .back-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .register-btn:hover, .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
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

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .role-select {
            width: 100%;
            padding: 12px;
            background-color: white;
            color: #1e293b;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            margin: 8px 0;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%231e293b'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }

        .role-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .role-select option {
            color: #1e293b;
            padding: 12px;
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

        <h2 style="text-align: center; color: #1e40af; font-size: 1.8rem; margin-bottom: 1.5rem;">New User Registration</h2>

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

            <select name="role" class="role-select" required>
                <option value="" disabled selected>Choose Role</option>
                <option value="Student">Student</option>
                <option value="Staff">Staff</option>
            </select>
            @error('role')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <div class="button-container">
                <button type="submit" class="register-btn">Register</button>
                <a href="{{ route('login.page') }}" class="back-btn">Back to Login</a>
            </div>
        </form>
    </div>
</body>
</html>
