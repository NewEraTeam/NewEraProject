<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            border-right: 1px solid #ddd;
            height: 100vh;
        }
        .sidebar a {
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 10px 0;
            color: #555;
            font-weight: bold;
        }
        .sidebar a:hover {
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .profile-header {
            text-align: center;
            background-color: #007BFF;
            color: white;
            padding: 20px;
            border-radius: 5px;
        }
        .profile-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .stats div {
            flex: 1;
            background: #f0f0f0;
            margin: 0 10px;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .button {
            text-align: center;
            padding: 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h3>ME</h3>
            <a href="#">My Profile</a>
            <a href="#">My Bookings</a>
            <a href="#">My Games</a>
            <a href="#">My Invoices</a>
            <h3>ACCOUNT SETTINGS</h3>
            <a href="#">Edit Profile</a>
            <a href="#">Link Social Accounts</a>
            <a href="#">Create Password</a>
            <a href="#">Language</a>
            <h3>SUPPORT</h3>
            <a href="#">Help Centre</a>
            <a href="#">WhatsApp Us</a>
        </div>
        <div class="main-content">
            <div class="profile-header">
                <img src="profile.jpg" alt="Profile Picture">
                <h2><?php echo htmlspecialchars($name); ?></h2>
                <p><?php echo htmlspecialchars($email); ?></p>
                <p>Joined since <?php echo htmlspecialchars($joinedSince); ?></p>
            </div>
            <div class="stats">
                <div>
                    <h3><?php echo htmlspecialchars($bookingsMade); ?></h3>
                    <p>Bookings Made</p>
                </div>
                <div>
                    <h3><?php echo htmlspecialchars($bookingHours); ?></h3>
                    <p>Booking Hours</p>
                </div>
                <div>
                    <h3><?php echo htmlspecialchars($gamesJoined); ?></h3>
                    <p>Games Joined</p>
                </div>
            </div>
            <div class="section">
                <h3>My Bookings</h3>
                <p><?php echo $bookingsMade > 0 ? "View your bookings here" : "No bookings made"; ?></p>
                <a href="#" class="button">Book Now</a>
            </div>
            <div class="section">
                <h3>My Invoices</h3>
                <p>RM<?php echo htmlspecialchars($spentAmount); ?> spent on sports this year</p>
            </div>
            <div class="section">
                <h3>My Games</h3>
                <p><?php echo $gamesJoined > 0 ? "View your games here" : "No games have been joined"; ?></p>
            </div>
        </div>
    </div>
</body>
</html>