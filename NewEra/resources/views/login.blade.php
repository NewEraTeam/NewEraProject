<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTM SPORT BOOKING SYSTEM - Login</title>

    <style>
        /* Basic resets */
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
            margin-top: 8rem; /* Increased from 4rem to 8rem */
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in;
            position: relative;
            z-index: 1;
        }

        .login-container {
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

        .login-container h2 {
            color: #1e40af;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .login-btn {
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

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .signup-btn {
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

        .signup-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        small {
            color: #dc2626;
            font-size: 0.875rem;
            display: block;
            margin-top: 0.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        @media (max-width: 768px) {
            .title {
                font-size: 2rem;
                padding: 0 1rem;
                text-align: center;
            }

            .login-container {
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Background Image Container -->
    <div class="background-image"></div>

    <!-- Title at the top center -->
    <div class="title">UTM SPORT BOOKING SYSTEM</div>

    <!-- Login Container -->
    <div class="login-container">
        <h2>Login</h2>

        <!-- Login Form -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            @error('username')
                <small>{{ $message }}</small>
            @enderror
            <br>

            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <small>{{ $message }}</small>
            @enderror
            @if ($errors->has('login'))
                <small>{{ $errors->first('login') }}</small>
            @endif
            <br>

            <div class="button-container">
                <button type="submit" class="login-btn">Login</button>
                <a href="{{ route('register.page') }}" class="signup-btn">New User Signup</a>
            </div>
        </form>
    </div>
</body>
</html>
