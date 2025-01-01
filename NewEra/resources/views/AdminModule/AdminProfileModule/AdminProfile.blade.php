<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - Sports Hall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body class="min-h-screen text-gray-800 bg-gray-100">
    <!-- Navbar Section -->
    <nav class="bg-white shadow-md">
        <div class="container flex items-center justify-between px-4 py-4 mx-auto">
            <!-- Logo -->
            <a href="{{route('AdminMainPage.page')}}" class="flex items-center">
                <img src="{{ asset('UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
            </a>
            <!-- Profile Button -->
            <div class="relative inline-block text-left">
                <button onclick="toggleAdminProfileMenu()" class="flex items-center space-x-2 bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                    <span class="text-lg material-symbols-outlined">admin_panel_settings</span>
                </button>
                <!-- Profile Dropdown -->
                <div id="adminProfileMenu" class="absolute right-0 z-10 hidden w-48 mt-2 bg-gray-100 border border-gray-200 rounded-lg shadow-lg">
                    <a href="{{ route('admin-profile') }}" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Profile</a>
                    <a href="logout" class="block px-4 py-2 text-sm font-semibold text-gray-700 border-t border-gray-200 hover:bg-gray-200">Log Out</a>
                </div>
            </div>
        </div>
    </nav>

    
    <!-- Profile Management Section -->
    <main class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-2xl font-bold text-center">Admin Profile</h1>
        <div class="max-w-4xl mx-auto bg-white p-6 border border-gray-200 rounded-lg shadow-lg">
            {{--
            <form action="{{ route('admin-profile-update') }}" method="POST" enctype="multipart/form-data"> 
                <div class="flex flex-col space-y-4">
                    
                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Full Name:</label>
                        <input type="text" name="full_name" placeholder=" Eg : ALI BIN ABU " required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                    <!-- UTM Gmail -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">UTM Email:</label>
                        <input type="email" name="utm_gmail" placeholder="yourname@utm.my" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                    <!-- Living Address -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Living Address:</label>
                        <input type="text" name="address" placeholder="Your Address" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                    <!-- Contact Number -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Contact Number:</label>
                        <input type="text" name="contact_number" placeholder="Eg : 01234567 " required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                         Update Profile
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-gray-100 mt-6">
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