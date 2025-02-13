<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Sports Hall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body class="min-h-screen text-gray-800 bg-gray-100">

    <!-- Navbar Section -->
    <nav class="bg-white shadow-md">
        <div class="container flex items-center justify-between px-4 py-4 mx-auto">
            <!-- Logo -->
            <a href="{{route('AdminMainPage.page')}}" class="flex items-center">
                <img src="{{ asset('ALLIMAGES/UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
            </a>
            <!-- Profile Button -->
            <div class="relative inline-block text-left">
                <button onclick="toggleAdminProfileMenu()" class="flex items-center space-x-2 bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                    <span class="text-lg material-symbols-outlined">admin_panel_settings</span>
                </button>
                <!-- Profile Dropdown -->
                <div id="adminProfileMenu" class="absolute right-0 z-10 hidden w-48 mt-2 bg-gray-100 border border-gray-200 rounded-lg shadow-lg">
                    <a href="{{ route('admin-profile') }}" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Profile</a>
                    <a href="{{ route('login.page') }}" class="block px-4 py-2 text-sm font-semibold text-gray-700 border-t border-gray-200 hover:bg-gray-200">Log Out</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Section -->
    <main class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-2xl font-bold text-center">Admin Dashboard</h1>
        <header class="relative mx-auto bg-center bg-cover h-96" style="background-image: url('{{ asset('ALLIMAGES/MAINGATE.jpeg') }}');">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="container relative flex flex-col items-center justify-center h-full mx-auto text-center text-white">
                <h1 class="mb-4 text-4xl font-bold">UTM Sports Management</h1>
                <p class="mb-6 text-lg">Welcome to Admin's Page</p>
            </div>
        </header>

        <!-- Admin Actions -->
        <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
            <!-- Manage Bookings -->
            <div class="p-6 text-center bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="mb-4 text-xl font-bold text-gray-800">Manage Bookings</h2>
                <button onclick="window.location='{{ route('AdminModule.AdminManageFacilitiesModule.booked-badminton') }}'" class="px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    View Bookings
                </button>
            </div>

            <!-- Manage Facilities -->
            <div class="p-6 text-center bg-white border border-gray-200 rounded-lg shadow-lg">
                <h2 class="mb-4 text-xl font-bold text-gray-800">Manage Facilities</h2>
                <button onclick="window.location='{{ route('admin-facilities') }}'" class="px-4 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">
                    Manage Facilities
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 mt-6 bg-gray-100">
        <div class="container px-4 mx-auto text-center">
            <p class="text-gray-500">© 2024 | UTM Sports Hall Admin Panel</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Toggle the Admin Profile dropdown
        function toggleAdminProfileMenu() {
            const menu = document.getElementById('adminProfileMenu');
            menu.classList.toggle('hidden');
        }
    </script>

</body>
</html>

