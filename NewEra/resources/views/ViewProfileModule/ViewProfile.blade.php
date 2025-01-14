<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - UTM Sports Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Material Symbols Outlined -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar Section -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4 flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="{{ route('view-mainpage') }}" class="flex items-center">
                <img src="{{ asset('ALLIMAGES/UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
            </a>

            <!-- Language & Account Buttons -->
            <div class="flex items-center space-x-4 ml-auto">
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

    <div class="flex pt-20">
        <!-- Sidebar -->
        <div id="sidebar" class="w-16 h-screen bg-white text-blue-600 p-4 shadow-lg fixed top-0 pt-20 transition-all duration-300">
            <button onclick="toggleSidebar()" class="text-blue-600 focus:outline-none transition-colors duration-300">
                <span id="burgerIcon" class="material-symbols-outlined">menu</span>
            </button>
            <div id="sidebarContent" class="hidden mt-6 space-y-2 bg-blue-700 text-white p-4 rounded-lg">
                <h2 class="text-2xl font-bold">Dashboard</h2>
                <nav class="mt-6 space-y-2">
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-500">Profile</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-500">My Bookings</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-500">Facilities</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-500">Settings</a>
                    <a href="{{ route('login.page') }}" class="block py-2.5 px-4 rounded hover:bg-red-500">Logout</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-16 transition-margin duration-300">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 mb-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="ml-6">
                        <h1 class="text-2xl font-bold">{{ Auth::user()->username }}</h1>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Overview --
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-lg font-semibold mb-2">Total Bookings</h3>
                    <p class="text-3xl font-bold">{{ $totalBookings ?? '0' }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-lg font-semibold mb-2">Active Bookings</h3>
                    <p class="text-3xl font-bold">{{ $activeBookings ?? '0' }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-lg font-semibold mb-2">Favorite Facility</h3>
                    <p class="text-3xl font-bold">{{ $favoriteFacility ?? 'None' }}</p>
                </div>
            </div>
            -->

            <!-- Recent Bookings -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Recent Bookings</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3">Facility</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Time</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings ?? [] as $booking)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $booking->facility_name }}</td>
                                <td class="px-6 py-4">{{ $booking->date }}</td>
                                <td class="px-6 py-4">{{ $booking->start_time }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' : ($booking->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-500 hover:text-blue-700">View</button>
                                    <button class="text-red-500 hover:text-red-700 ml-3">Cancel</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">No bookings found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('languageMenu').classList.toggle('hidden');
        }

        function toggleProfileMenu() {
            document.getElementById('profileMenu').classList.toggle('hidden');
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const sidebarContent = document.getElementById('sidebarContent');
            const burgerIcon = document.getElementById('burgerIcon');
            const mainContent = document.querySelector('.flex-1');

            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-16');
            sidebarContent.classList.toggle('hidden');
            sidebar.classList.toggle('bg-white');
            sidebar.classList.toggle('bg-blue-700');
            burgerIcon.classList.toggle('text-blue-600');
            burgerIcon.classList.toggle('text-white');
            mainContent.classList.toggle('ml-64');
            mainContent.classList.toggle('ml-16');
        }
    </script>
</body>
</html>