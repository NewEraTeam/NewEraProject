<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Hall | User Profile</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navbar ul li {
            margin: 0 15px;
            cursor: pointer;
        }

        .navbar .user-icon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /* Sidebar */
        .sidebar {
            width: 20%;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li button {
            margin: 5px;
        }

        /* Profile Section */
        .profile-section {
            width: 80%;
            padding: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            background-color: #f1f8ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-info h2 {
            margin: 0;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .stats div {
            text-align: center;
        }

        .content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>

</head>

<body>
    <header class="navbar">
        <div class="logo">UTM Sports Hall</div>
        <nav>
            <ul>
                <li>Explore</li>
                <li>Book</li>
                <li>Games</li>
                <li>Deals</li>
            </ul>
        </nav>
        <div class="user-icon">
            <img src="profile-picture.jpg" alt="Profile Picture">
        </div>
    </header>

    <main>
        <aside class="sidebar">
            <ul>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">My Bookings</a></li>
                <li><a href="#">My Games</a></li>
                <li><a href="#">My Invoices</a></li>
                <li><a href="#">Edit Profile</a></li>
                <li><a href="#">Link Social Accounts</a></li>
                <li><a href="#">Create Password</a></li>
                <li>
                    <span>Language:</span>
                    <button>EN</button>
                    <button>BM</button>
                    <button>中文</button>
                </li>
            </ul>
        </aside>

        <section class="profile-section">
            <div class="profile-header">
                <img src="profile-picture.jpg" alt="Profile" class="profile-pic">
                <div class="profile-info">
                    <h2></h2>
                    <p></p>
                    <p>Joined since </p>
                </div>
            </div>

            <div class="stats">
                <div>
                    <h3>0</h3>
                    <p>Bookings made</p>
                </div>
                <div>
                    <h3>0</h3>
                    <p>Booking hours</p>
                </div>
                <div>
                    <h3>0</h3>
                    <p>Games joined</p>
                </div>
            </div>

            <div class="content">
                <div class="box">
                    <h3>My Bookings</h3>
                    <p>No booking made</p>
                    <button>Book Now</button>
                </div>
                <div class="box">
                    <h3>My Invoices</h3>
                    <p>RM 0 spent on sports this year</p>
                </div>
                <div class="box">
                    <h3>My Games</h3>
                    <p>No games have been joined</p>
                </div>
                <div class="box">
                    <h3>My Contact</h3>
                    <p></p>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
