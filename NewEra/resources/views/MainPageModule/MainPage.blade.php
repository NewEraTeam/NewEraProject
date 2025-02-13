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
<body class="min-h-screen text-gray-800 bg-gray-100">

        <!-- Navbar Section -->
        <nav class="bg-white shadow-md">
            <div class="container flex items-center justify-between px-4 py-4 mx-auto">
                <!-- Logo -->
                <a href="{{ route('view-mainpage') }}" class="flex items-center">
                    <img src="{{ asset('ALLIMAGES/UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
                </a>

                <!-- Language & Account Buttons -->
                <div class="relative flex items-center space-x-4">
                    <!-- Language Dropdown -->
                    <div class="relative">

                    <!-- Profile Icon and Dropdown -->
                    <div class="relative inline-block text-left">
                        <!-- Profile Icon Button -->
                        <button onclick="toggleProfileMenu()" class="flex items-center space-x-2 bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                            <span class="text-lg material-symbols-outlined">person</span>
                        </button>

                        <!-- Profile Dropdown Menu -->
                        <div id="profileMenu" class="absolute right-0 z-10 hidden w-48 mt-2 bg-gray-100 border border-gray-200 rounded-lg shadow-lg">

                            <a href="{{route ('view-profile')}}" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Profile</a>
                            <a href="{{route ('customer-booking')}}" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Booking History</a>
                            <a href="{{ route('about-us') }}" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">About</a>
                            <a href="{{ route('login.page') }}" class="block px-4 py-2 text-sm font-semibold text-gray-700 border-t border-gray-200 hover:bg-gray-200">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Link to the JavaScript files -->
        <script src="{{ asset('js/profileDropdown.js') }}"></script>
        <script src="{{ asset('js/languageDropdown.js') }}"></script>

    <!-- Hero Section -->
    <header class="relative mx-auto bg-center bg-cover h-96" style="background-image: url('{{ asset('ALLIMAGES/MAINGATE.jpeg') }}');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="container relative flex flex-col items-center justify-center h-full mx-auto text-center text-white">
            <h1 class="mb-4 text-4xl font-bold">Get Active, Book Your Place Now</h1>
            <p class="mb-6 text-lg">From favorites like badminton and swimming to track and gym, Book now to get active!</p>
        </div>
    </header>

    <!-- Facilities Section -->
    <section class="container px-4 py-8 mx-auto">
        <h2 class="mb-6 text-2xl font-bold text-center">Facilities Available</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">

            <!-- Facility Card 1 -->
            <div class="p-4 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg">
                <img src="{{ asset('ALLIMAGES/SPORTSHALL.jpeg') }}" alt="UTM Sports Hall" class="object-cover w-full mx-auto mb-4 rounded-lg h-60">
                <p class="text-sm font-semibold text-gray-500">BADMINTON</p>
                <h3 class="mb-2 text-lg font-bold">Sports Hall</h3>
                <p class="mb-4 text-sm text-gray-500">UTM JB</p>
                <div class="flex items-center justify-between">
                    <!-- View Button -->
                    <button onclick="window.location='{{ route('badminton') }}'" class="flex items-center px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100">
                        <span class="mr-1 text-base material-symbols-outlined">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button onclick="window.location='{{ route('bookingBadminton') }}'" class="px-4 py-2 font-semibold text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- Facility Card 2 -->
            <div class="p-4 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg">
                <img src="{{ asset('ALLIMAGES/SWIMMINGPOOL.jpeg') }}" alt="Swimming Pool UTM" class="object-cover w-full mx-auto mb-4 rounded-lg h-60">
                <p class="text-sm font-semibold text-gray-500">SWIMMING</p>
                <h3 class="mb-2 text-lg font-bold">Swimming Pool</h3>
                <p class="mb-4 text-sm text-gray-500">UTM JB</p>
                <div class="flex items-center justify-between">
                    <!-- View Button -->
                    <button onclick="window.location='{{ route('swimming') }}'" class="flex items-center px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100">
                        <span class="mr-1 text-base material-symbols-outlined">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button onclick="window.location='{{ route('bookingSwimming') }}'" class="px-4 py-2 font-semibold text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- Facility Card 3 -->
            <div class="p-4 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg">
                <img src="{{ asset('ALLIMAGES/STADIUM.jpeg') }}" alt="Stadium Azman Hashim UTM" class="object-cover w-full mx-auto mb-4 rounded-lg h-60">
                <p class="text-sm font-semibold text-gray-500">TRACK & FIELD</p>
                <h3 class="mb-2 text-lg font-bold">Field</h3>
                <p class="mb-4 text-sm text-gray-500">UTM JB</p>
                <div class="flex items-center justify-between">
                    <!-- View Button -->
                    <button onclick="window.location='{{ route('stadium') }}'" class="flex items-center px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100">
                        <span class="mr-1 text-base material-symbols-outlined">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button onclick="window.location='{{ route('bookingStadium') }}'" class="px-4 py-2 font-semibold text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>

            <!-- Facility Card 4 -->
            <div class="p-4 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg">
                <img src="{{ asset('ALLIMAGES/GYM.jpeg') }}" alt="UTM Gym" class="object-cover w-full mx-auto mb-4 rounded-lg h-60">
                <p class="text-sm font-semibold text-gray-500">GYM</p>
                <h3 class="mb-2 text-lg font-bold">Gymnasium</h3>
                <p class="mb-4 text-sm text-gray-500">UTM JB</p>
                <div class="flex items-center justify-between">
                    <!-- View Button -->
                    <button onclick="window.location='{{ route('gym') }}'" class="flex items-center px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100">
                        <span class="mr-1 text-base material-symbols-outlined">visibility</span>
                        View
                    </button>
                    <!-- Book Now Button -->
                    <button onclick="window.location='{{ route('bookingGym') }}'" class="px-4 py-2 font-semibold text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200">
                        Book Now
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer Section -->
    <footer class="py-8 bg-white border-t border-gray-200">
        <div class="container px-4 mx-auto">
            <!-- Top Section of Footer -->
            <div class="flex flex-col items-center justify-between space-y-6 lg:flex-row lg:items-start lg:space-y-0">
                <!-- Logo Section -->
                <a href="#" class="flex items-center">
                    <img src="{{ asset('ALLIMAGES/UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
                </a>

                <!-- Links Section -->
                <div class="grid grid-cols-2 gap-4 text-center md:grid-cols-3 lg:grid-cols-5 lg:text-left">

                    <div >
                        <!-- Copyright -->
                        <p>
                            © 2024 | UTM Sports Hall
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </footer>

</body>
</html>
