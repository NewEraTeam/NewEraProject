<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Material Symbols Outlined -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('{{ asset("UTM Campus.png") }}');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #2563eb;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            padding: 2rem;
            margin: 1rem 0;
        }

        .section-card:hover {
            transform: translateY(-5px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <!-- Navbar Section -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="#" class="flex items-center">
                <img src="{{ asset('UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
            </a>

            <!-- Language & Account Buttons -->
            <div class="flex items-center space-x-4">
                <!-- Language Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                        <span class="material-symbols-outlined text-base mr-1">language</span> EN
                        <span class="material-symbols-outlined ml-1">expand_more</span>
                    </button>
                    <div id="languageMenu" class="hidden absolute right-0 mt-2 w-20 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">BM</a>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">中文</a>
                    </div>
                </div>

                <!-- Profile Icon -->
                <div class="relative inline-block text-left">
                    <button onclick="toggleProfileMenu()" class="flex items-center bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                        <span class="material-symbols-outlined text-lg">person</span>
                    </button>
                    <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-100 rounded-lg shadow-lg border border-gray-200 z-10">
                        <a href="#" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold mb-4 animate-fade-in">About UTM Sports Facilities</h1>
            <p class="text-xl mb-8 animate-fade-in">Empowering athletes, fostering community</p>
        </div>
    </div>

    <!-- About Us Section -->
    <section class="container mx-auto px-4 py-8">
        <h1 class="text-center text-3xl font-bold mb-4">About Us</h1>
        <p class="text-center text-lg text-gray-600 mb-8">
            Welcome to UTM Sports Hall! We’re dedicated to providing students and community members access to the best sports facilities and promoting a healthy, active lifestyle.
        </p>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">Our Mission</h2>
                <p class="text-gray-700">To provide top-notch facilities and foster a welcoming environment for everyone to stay active, develop new skills, and achieve their fitness goals.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">Our Vision</h2>
                <p class="text-gray-700">To be recognized as a leading sports facility in the region, nurturing athletes, promoting health, and inspiring the next generation of fitness enthusiasts.</p>
            </div>
        </div>

        <!-- Facilities Overview -->
        <div class="bg-blue-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-center mb-12 text-blue-800">Our Facilities</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="section-card text-center">
                        <span class="material-symbols-outlined text-5xl text-blue-600 mb-4">sports_soccer</span>
                        <h3 class="text-xl font-bold mb-2">Sports Fields</h3>
                        <p class="text-gray-600">Professional-grade fields for football, rugby, and more</p>
                    </div>
                    <div class="section-card text-center">
                        <span class="material-symbols-outlined text-5xl text-blue-600 mb-4">pool</span>
                        <h3 class="text-xl font-bold mb-2">Swimming Pool</h3>
                        <p class="text-gray-600">Olympic-sized swimming pool with training facilities</p>
                    </div>
                    <div class="section-card text-center">
                        <span class="material-symbols-outlined text-5xl text-blue-600 mb-4">fitness_center</span>
                        <h3 class="text-xl font-bold mb-2">Gymnasium</h3>
                        <p class="text-gray-600">State-of-the-art gym equipment and training areas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <h2 class="text-center text-2xl font-bold mb-6">Meet Our Team</h2>

        <!-- Sports Director -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Sports Director</h3>
            <p class="text-center text-gray-800">Armadi b. Ahmad</p>
        </div>

        <!-- Senior Officers -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Senior Officers of Administrative</h3>
            <p class="text-center text-gray-800">Rizam bin Rahmat, Mohd Sharul Mohd Shahimi</p>
        </div>

        <!-- Officers of Administrative -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Officer of Administrative</h3>
            <p class="text-center text-gray-800">Wan Eizalie b. Wan Mohamed Nor</p>
        </div>

        <!-- Senior Assistant Officers of Youth & Sports -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Senior Assistant Officers of Youth & Sports</h3>
            <p class="text-center text-gray-800">Rodiah bt. Kasiran (Mass), Shahril Annuar b. Bahrom (Development)</p>
        </div>

        <!-- Assistant Officers of Youth & Sports -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Assistant Officers of Youth & Sports</h3>
            <p class="text-center text-gray-800">
                Azman b. Jamalludin (Facilities), Muhamad Amirul Hanif bin Md Tahir (Administrative), Muhammad Hanif Asraf bin Hassan (Recreation), Mus’ab bin Abd Razak (High Performance)
            </p>
        </div>

        <!-- Senior Assistants of Youth & Sports -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Senior Assistants of Youth & Sports</h3>
            <p class="text-center text-gray-800">
                Nazri Hisam b. Husain (High Performance), Nor Rohimin b. Sanee (Facilities), Abd Afiq b. Abd Wahab (Mass), Muhammad Ridzuan b. Norazlan (Development), Zulaiha bt. Uni Harun (Mass)
            </p>
        </div>

        <!-- Assistants of Youth & Sports -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Assistants of Youth & Sports</h3>
            <p class="text-center text-gray-800">
                Zul Fahmee b. Ahmad Zin (Facilities), Muhamad Sazali Bin Muhadzir (High Performance)
            </p>
        </div>

        <!-- Others -->
        <div class="bg-white shadow-lg rounded-lg p-4 mb-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-center text-blue-600">Others</h3>
            <p class="text-center text-gray-800">
                Latifah binti Abd Jalil, Habibah binti Gono, Salwati binti Ishak, Nur Safikah binti Bakar, Norzaidi bin Subahir, Erwan bin Saman, Raja Khairulzaman bin Raja Kamarudin, Mohd Hafiz bin Mohd Ali, Mohd Shah Rizal bin Abd Hamid, Abdul Fahmi bin Ruzali, Azman bin Muhammad, Mohamad Afiq Azim bin Azuan
            </p>
        </div>

    </section>

    <!-- Footer Section -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500">© 2024 UTM Sports Hall. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript for Dropdowns -->
    <script src="{{ asset('js/profileDropdown.js') }}"></script>
    <script src="{{ asset('js/languageDropdown.js') }}"></script>
</body>
</html>
