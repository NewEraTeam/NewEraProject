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
<body class="min-h-screen bg-gray-100">
    <!-- Navbar Section -->
    <nav class="fixed z-50 w-full bg-white shadow-md">
        <div class="container flex items-center justify-between px-4 py-4 mx-auto">
            <!-- Logo -->
            <a href="{{ route('view-mainpage') }}" class="flex items-center">
                <img src="{{ asset('ALLIMAGES/UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
            </a>

            <!-- Language & Account Buttons -->
            <div class="flex items-center ml-auto space-x-4">
                <!-- Profile Icon -->
                <div class="relative inline-block text-left">
                    <button onclick="toggleProfileMenu()" class="flex items-center bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                        <span class="text-lg material-symbols-outlined">person</span>
                    </button>
                    <div id="profileMenu" class="absolute right-0 z-10 hidden w-48 mt-2 bg-gray-100 border border-gray-200 rounded-lg shadow-lg">
                        <a href="#" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-20">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 w-16 h-screen p-4 pt-20 text-blue-600 transition-all duration-300 bg-white shadow-lg">
            <button onclick="toggleSidebar()" class="text-blue-600 transition-colors duration-300 focus:outline-none">
                <span id="burgerIcon" class="material-symbols-outlined">menu</span>
            </button>
            <div id="sidebarContent" class="hidden p-4 mt-6 space-y-2 text-white bg-blue-700 rounded-lg">
                <h2 class="text-2xl font-bold">Dashboard</h2>
                <nav class="mt-6 space-y-2">
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-500">Profile</a>
                    <a href="#" class="block py-2.5 px-4 rounded hover:bg-blue-500">My Bookings</a>
                    <a href="{{ route('login.page') }}" class="block py-2.5 px-4 rounded hover:bg-red-500">Logout</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-16 duration-300 transition-margin">
            <!-- Profile Header -->
            <div class="p-6 mb-6 text-white rounded-lg shadow-md bg-gradient-to-r from-blue-500 to-blue-700">
                <div class="flex items-center">
                    <div class="ml-6">
                        <h1 class="text-2xl font-bold">{{ Auth::user()->username }}</h1>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Overview --
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                    <h3 class="mb-2 text-lg font-semibold">Total Bookings</h3>
                    <p class="text-3xl font-bold">{{ $totalBookings ?? '0' }}</p>
                </div>
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                    <h3 class="mb-2 text-lg font-semibold">Active Bookings</h3>
                    <p class="text-3xl font-bold">{{ $activeBookings ?? '0' }}</p>
                </div>
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                    <h3 class="mb-2 text-lg font-semibold">Favorite Facility</h3>
                    <p class="text-3xl font-bold">{{ $favoriteFacility ?? 'None' }}</p>
                </div>
            </div>
            -->

            <!-- Recent Bookings -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-xl font-bold">Recent Bookings</h2>
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
                                    <button class="ml-3 text-red-500 hover:text-red-700">Cancel</button>
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
