<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Action - Sports Hall</title>
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

    <!-- Main Content -->
    <main class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-2xl font-bold text-center">Welcome</h1>
        <div class="flex items-center justify-center">
            <p class="text-lg text-gray-700">Welcome to the Admin Action page!</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-white border-t border-gray-200">
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
