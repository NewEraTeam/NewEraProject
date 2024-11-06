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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            color: white;
            position: relative;
            overflow: hidden;
        }

        /* Load background image and apply blur */
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0'); /* Use a direct online image URL */
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            z-index: -1;
        }

        /* Title styling */
        .title {
            color: black;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .login-container h2 {
            margin-bottom: 1rem;
            color: black;
        }

        .login-container input {
            width: 100%;
            padding: 0.5rem;
            margin: 0.5rem 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .login-container button {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 4px;
            margin-top: 1rem;
            cursor: pointer;
        }

        .login-btn {
            background-color: #4CAF50;
            color: white;
        }

        .signup-btn {
            background-color: #2196F3;
            color: white;
            margin-top: 0.5rem;
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

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" class="login-btn">Login</button>
        </form>

        <form action="{{ route('search.page') }}" method="GET">
            <button type="submit" class="signup-btn">New User Signup</button>
        </form>
    </div>
</body>
</html>
