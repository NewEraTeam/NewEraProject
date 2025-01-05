<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Facilities - Sports Hall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/adminFacilities.js" defer></script> 
</head>
<body class="min-h-screen text-gray-800 bg-gray-100">

    <nav class="bg-white shadow-md">
        <div class="container flex items-center justify-between px-4 py-4 mx-auto">
            <a href="{{route('AdminMainPage.page')}}" class="flex items-center">
                <img src="{{ asset('ALLIMAGES/UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
            </a>
            <div class="relative inline-block text-left">
                <button onclick="toggleAdminProfileMenu()" class="flex items-center space-x-2 bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full font-semibold hover:bg-blue-200 focus:outline-none">
                    <span class="text-lg material-symbols-outlined">admin_panel_settings</span>
                </button>
                <div id="adminProfileMenu" class="absolute right-0 z-10 hidden w-48 mt-2 bg-gray-100 border border-gray-200 rounded-lg shadow-lg">
                    <a href="{{ route('admin-profile') }}" class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Profile</a>
                    <a href="{{ route('login.page') }}" class="block px-4 py-2 text-sm font-semibold text-gray-700 border-t border-gray-200 hover:bg-gray-200">Log Out</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-2xl font-bold text-center">Admin Facility Management</h1>

        <div class="mb-8 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Close Venue</h2>
            <div class="flex justify-center space-x-4">
                <div class="flex items-center">
                    <select id="venueSelect" class="bg-white text-black px-4 py-2 rounded hover:bg-white-600 w-full shadow-md border border-gray-600 rounded">
                        <option value="" disabled selected>Select Venue</option>
                        <option value="venue1">Badminton Court</option>
                        <option value="venue2">Swimming Pool</option>
                        <option value="venue3">Gym</option>
                        <option value="venue4">Stadium</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <select id="reasonSelect" class="bg-white text-black px-4 py-2 rounded hover:bg-white-600 w-full shadow-md border border-gray-600 rounded">
                        <option value="" disabled selected>Occasions</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="booked">Booked</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Block Date</h2>
            <p class="mb-4 text-gray-700">Select the dates you want to block for bookings:</p>
            <input type="date" id="blockDateInput" class="border border-gray-600 rounded px-4 py-2 mb-4 shadow-md" />
            <button id="blockDateButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 shadow-md">Block Date</button>
        </div>
    </main>

    <footer class="py-8 bg-white border-t border-gray-200"> 
        <div class="container px-4 mx-auto text-center">
            <p class="text-gray-500">© 2024 | UTM Sports Hall Admin Panel</p>
        </div>
    </footer>

    <script src="/js/adminFacilities.js"></script> 

    <script>
        // Toggle the Admin Profile dropdown
        function toggleAdminProfileMenu() {
            const menu = document.getElementById('adminProfileMenu');
            menu.classList.toggle('hidden');
        }
    </script>

</body>
</html>