<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Hall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Material Symbols Outlined -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

    <!-- Navbar Section -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="#" class="text-2xl font-bold text-blue-600">sportshall</a>

            <!-- Language & Account Buttons -->
            <div class="relative flex items-center space-x-4">
                <!-- Language Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                        <span class="material-symbols-outlined text-base mr-1">language</span>
                        EN
                    </button>
                </div>

                <!-- Help Link -->
                <a href="#" class="text-gray-700 hover:text-blue-600">Help</a>

                <!-- Profile Icon -->
                <a href="#" class="text-gray-700 hover:text-blue-600">
                    <span class="material-symbols-outlined text-3xl">account_circle</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-cover bg-center h-96" style="background-image: url('https://via.placeholder.com/1920x500');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative container mx-auto h-full flex flex-col justify-center items-center text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Get Active, Book Your Place Now</h1>
            <p class="mb-6 text-lg">From favorites like badminton and swimming to track and gym, Book now to get active!</p>
        </div>
    </header>

    <!-- Facilities Section -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-center text-2xl font-bold mb-6">Facilities Available</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            
            <!-- Facility Card 1 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 p-4">
                <img src="https://via.placeholder.com/400x200" alt="Club 360 @ Setia Ecohill" class="w-full h-48 object-cover rounded-lg mb-4">
                <p class="text-sm font-semibold text-gray-500">BADMINTON</p>
                <h3 class="text-lg font-bold mb-2">Sports Hall</h3>
                <p class="text-sm text-gray-500 mb-4">UTM JB</p>
                <div class="flex justify-between items-center">
                    <!-- View Button -->
                    <button class="flex items-center text-gray-600 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100">
                        <span class="material-symbols-outlined text-base mr-1">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>
    
            <!-- Facility Card 2 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 p-4">
                <img src="https://via.placeholder.com/400x200" alt="LakePoint Club @ Setia Alam Impian" class="w-full h-48 object-cover rounded-lg mb-4">
                <p class="text-sm font-semibold text-gray-500">SWIMMING</p>
                <h3 class="text-lg font-bold mb-2">Swimming Pool</h3>
                <p class="text-sm text-gray-500 mb-4">UTM JB</p>
                <div class="flex justify-between items-center">
                    <!-- View Button -->
                    <button class="flex items-center text-gray-600 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100">
                        <span class="material-symbols-outlined text-base mr-1">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>
    
            <!-- Facility Card 3 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 p-4">
                <img src="https://via.placeholder.com/400x200" alt="JC Badminton Centre @ Serdang Baru" class="w-full h-48 object-cover rounded-lg mb-4">
                <p class="text-sm font-semibold text-gray-500">TRACK & FIELD</p>
                <h3 class="text-lg font-bold mb-2">Field</h3>
                <p class="text-sm text-gray-500 mb-4">UTM JB</p>
                <div class="flex justify-between items-center">
                    <!-- View Button -->
                    <button class="flex items-center text-gray-600 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100">
                        <span class="material-symbols-outlined text-base mr-1">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>
    
            <!-- Facility Card 4 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 p-4">
                <img src="https://via.placeholder.com/400x200" alt="Penang Badminton Academy @ Bukit Dumbar" class="w-full h-48 object-cover rounded-lg mb-4">
                <p class="text-sm font-semibold text-gray-500">GYM</p>
                <h3 class="text-lg font-bold mb-2">Gymnasium</h3>
                <p class="text-sm text-gray-500 mb-4">UTM JB</p>
                <div class="flex justify-between items-center">
                    <!-- View Button -->
                    <button class="flex items-center text-gray-600 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100">
                        <span class="material-symbols-outlined text-base mr-1">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>
    
        </div>
    </section>
    
    <!-- Footer Section -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="container mx-auto px-4">
            <!-- Top Section of Footer -->
            <div class="flex flex-col lg:flex-row justify-between items-center lg:items-start space-y-6 lg:space-y-0">
                <!-- Logo Section -->
                <div class="text-center lg:text-left">
                    <a href="#" class="text-blue-600 text-2xl font-bold">sportshall</a>
                </div>

                <!-- Links Section -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 text-center lg:text-left">
                    <!-- For Business -->
                    <div>
                        <h5 class="font-semibold text-gray-800">For Business</h5>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Facility Management</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Schedule a Demo</a></li>
                        </ul>
                    </div>

                    <!-- About -->
                    <div>
                        <h5 class="font-semibold text-gray-800">About</h5>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">About Us</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Blog</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Careers</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h5 class="font-semibold text-gray-800">Support</h5>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Help Centre</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h5 class="font-semibold text-gray-800">Legal</h5>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Terms of Use</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-blue-600">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Section of Footer -->
            <div class="mt-8 border-t border-gray-200 pt-4 flex flex-col lg:flex-row justify-between items-center">
                <!-- Copyright -->
                <p class="text-gray-500 text-center lg:text-left">
                    © 2024 | UTM Sports Hall
                </p>
            </div>
        </div>
    </footer>
    
</body>
</html>
