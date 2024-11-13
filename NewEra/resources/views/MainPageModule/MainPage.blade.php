<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTM Facilities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Extra styling for dropdown visibility */
        .dropdown-content {
            display: none;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Header styling */
        header {
            background-image: url('your_background_image.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;  

            height: 18vh; /* Adjust height as needed */
            color: #fff;
            padding: 1rem;
        }

        .custom-header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .custom-header .logo {
            width: 150px; /* Adjust logo size */
            height: auto;
        }

        .custom-header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .custom-header nav li {
            margin-right: 20px;
        }

        .search-container {
            position: relative;
            z-index: 1; /* Higher z-index to overlap other elements */
        }

        .custom-header .search-bar {
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 10px;
            background-color: #fff; /* Set background color to white */
            border: 1px solid #000; /* Add a 1px black border */
        }

        .custom-header .search-bar input {
            padding: 10px;
            border: none; /* Remove border from input */
            border-radius: 5px 0 0 5px;
        }

        .custom-header .search-bar button {
            padding: 10px 20px;
            background-color: #007bff; /* Blue background for button */
            color: #fff;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        /* Main content styles */
        .banner {
            position: relative;
        }

        .banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        .facility-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .facility-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
    <header class="custom-header">
        <div class="flex items-center">
          <img src="logo.png" alt="Logo" class="logo">
          <nav>
            <ul>
              <li><a href="#">Home</a></li>
              <li class="dropdown relative">
                <button class="text-white hover:underline">Facilities</button>
                <div class="dropdown-content absolute left-0 mt-2 bg-gray-700 text-white rounded-md shadow-lg p-4">
                  <ul>
                    <li><a href="#">Sports Hall</a></li>
                    <li><a href="#">Swimming Pool</a></li>
                    <li><a href="#">Track Field</a></li>
                    <li><a href="#">Gymnasium</a></li>
                  </ul>
                </div>
              </li>
              <li><a href="#">Booking</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </nav>
        </div>
        <div class="search-container">
            <form class="flex items-center bg-white rounded-lg p-4">
                <input type="text" placeholder="Search venue name" class="flex-1 mr-4 p-2 border border-gray-300 rounded">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>  
          
              </form>
          </div>
      </header>

    <main class="flex-grow">
        <section class="banner relative overflow-hidden rounded-lg mb-12">
            <img src="banner_image.jpg" alt="Banner Image" class="w-full h-full object-cover absolute top-0 left-0">
            <div class="banner-content absolute bottom-0 left-0 right-0 px-4 py-8 text-white">
                <h2 class="text-2xl font-bold mb-2">Explore Our Facilities</h2>
                <p class="text-lg mb-4">Book your spot and get active!</p>
                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Book Now</a>
            </div>
        </section>

        <h2 class="text-center text-2xl font-bold mb-6">Our Facilities</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="facility-card">
                <img src="badminton_court.jpg" alt="Sports Hall">
                <h3>Sports Hall</h3>
                <p>State-of-the-art badminton courts for all skill levels.</p>
                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Book Now</a>
            </div>

            <div class="facility-card">
                <img src="basketball_court.jpg" alt="Swimming Pool">
                <h3>Swimming Pool</h3>
                <p>Perfect for a game of hoops with friends.</p>
                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Book Now</a>
            </div>

            <div class="facility-card">
                <img src="basketball_court.jpg" alt="Field">
                <h3>Field</h3>
                <p>Perfect for a game of hoops with friends.</p>
                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Book Now</a>
            </div>

            <div class="facility-card">
                <img src="basketball_court.jpg" alt="Gymnasium">
                <h3>Gymansium</h3>
                <p>Perfect for a game of hoops with friends.</p>
                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Book Now</a>
            </div>

            </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        </footer>
</body>
</html>
