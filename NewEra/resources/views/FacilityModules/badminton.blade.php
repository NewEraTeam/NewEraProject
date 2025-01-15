<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Information</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"> <!-- AOS for animations -->
    <style>
        /* Basic resets */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            overflow-y: scroll;
            position: relative;
        }

        /* Fixed blurred background image */
        body::before {
            content: '';
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

        /* Header styling */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            z-index: 100;
            transition: background-color 0.3s;
        }

        .header.transparent {
            background-color: rgba(0, 0, 0, 0.3); /* Transparent background on top */
        }

        .header.solid {
            background-color: rgba(0, 0, 0, 0.7); /* Solid background when scrolled down */
        }

        /* Header Logo */
        .logo {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .logo img {
            width: 130px;
            height: auto;
        }

        /* Header title styling */
        .header-title {
            font-size: 2rem;
            font-family: 'Verdana', sans-serif;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px #000;
        }

        /* Main content container styling with top padding */
        .content-container {
            padding: 110px 20px 40px; /* Add padding-top to push content below header */
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            max-width: 1000px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        /* Facility images styling */
        .images-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            padding-right: 20px;
        }

        .images-container img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Text container styling */
        .text-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-left: 5px solid #ac551ae3;
            text-align: center; /* Center the content */
        }

        .text-content {
            font-size: 1.1em;
            line-height: 1.6em;
            color: #333;
            margin-bottom: 20px;
        }

        /* Centered Book button styling */
        .book-btn {
            padding: 12px 30px;
            background-color: #aC551AE3;
            color: white;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 20px auto 0; /* Center horizontally */
        }

        .book-btn:hover {
            background-color: #da691fe3;
        }
    </style>
</head>
<body>
    <!-- Fixed Header -->
    <div class="header transparent" id="header">
        <div class="logo">
            <a href="{{ route('MainPage.page') }}">
                <img src="{{ asset('ALLIMAGES/UTM-LOGO-FULL.png') }}" alt="UTM Logo">
            </a>
        </div>
        <div class="header-title">BADMINTON</div>
    </div>

    <!-- Content Container with Facility Information -->
    <div class="content-container">
        <!-- Images Section -->
        <div class="images-container" data-aos="fade-up">
            <img src="https://scontent-sin2-1.xx.fbcdn.net/v/t39.30808-6/454859484_475671961983417_1041939519624185605_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=R8fzfI9-HlcQ7kNvgFajv69&_nc_zt=23&_nc_ht=scontent-sin2-1.xx&_nc_gid=Ato0pxVq5yo6kRsLJGaZcgr&oh=00_AYBun9-5LKrStVmzIjGGah-UOplfiPvwpVZ2mDLGHKsUPw&oe=678CE44E" alt="Facility Image 1">
            <img src="https://scontent-sin6-3.xx.fbcdn.net/v/t1.6435-9/69941826_1373632162786444_1021120735092932608_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=833d8c&_nc_ohc=NTkijCffuMoQ7kNvgHlB-fz&_nc_zt=23&_nc_ht=scontent-sin6-3.xx&_nc_gid=AmrPxee46fwmXeYbG5o6hzg&oh=00_AYB-4NARkG--ot1Xna5XzWAIkjBVx4eNGOz8t6o4b05y4Q&oe=67AE5D77" alt="Facility Image 3">
            <img src="https://scontent-sin6-1.xx.fbcdn.net/v/t1.6435-9/86458082_168790407908224_5255624516586962944_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=833d8c&_nc_ohc=cZFBqoo7t00Q7kNvgHNoXRU&_nc_zt=23&_nc_ht=scontent-sin6-1.xx&_nc_gid=AToWaCXfqO8LJxyf9Q-zpPj&oh=00_AYA2Cgq4e_925za1djxiOzDlXU_MnCVECZIf-KBkI5G-Dw&oe=67AE5FBF" alt="Facility Image 4">
        </div>

        <!-- Text Container -->
        <div class="text-container" data-aos="fade-up">
            <div class="text-content">
                <p >Experience the thrill of badminton at UTM's state-of-the-art <b>Sports Hall!</b> Whether you're a seasoned player or just looking to enjoy a fun game with friends, our courts are designed to meet your needs.</p> </br>
                <p >We provided several features for UTM Students and Staff</p></br>
                <ul>
                    <?php
                    // Array of features
                    $features = [
                        "Well-maintained courts for optimal gameplay",
                        "Adequate lighting for evening matches",
                        "Easily accessible location within the campus"
                    ];

                    // Loop through the features array and display each item as a list
                    foreach ($features as $feature) {
                        echo "<li>$feature</li>";
                    }
                    ?>
                </ul> </br>
                <p><b>Sports Hall Operating Hour</b></p>
                <p>Monday - Friday : (8:30am - 10:00pm)</p>
                <p>Saturday - Sunday : (8:30am - 7:00pm)</p></br>
                <p><b>Officer in Charge (Contact)</b></p>
                <p><b>Mr. Sharul Bin Mohd. Shahimi</b></p>
                <p>Sport & Youth Officer</p>
                <p>Phone : 07-5535776</p></br>
                <p><b>Mr. Azman Bin Jamalludin</b></p>
                <p>Sports & Youth Assistant Officer</p>
                <p>Phone : 07-5536227</p></br>
                <p><b>General Office</b></p>
                <p>Phone : 07-5535775/35766/35774</p></br>
                <p><b>Our Location</b></p>
                <p>Jalan Kempas 2, Skudai, 80990 Johor Bahru, Johor</p>
                <p><a href="https://maps.app.goo.gl/XCsZcZT1gritpHU26" target="_blank">Google Map</a></p>
            </div>
            <!-- Centered Book Button at the Bottom -->
            <!-- should out this "onclick="window.location.href='{ route('booking.page') }}'"" inside the button-->
            <button onclick="window.location='{{ route('bookingBadminton') }}'" class="book-btn">Book Facility</button>
        </div>
    </div>

    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Change header background on scroll
        window.addEventListener('scroll', function () {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.remove('transparent');
                header.classList.add('solid');
            } else {
                header.classList.remove('solid');
                header.classList.add('transparent');
            }
        });
    </script>
</body>

</html>
