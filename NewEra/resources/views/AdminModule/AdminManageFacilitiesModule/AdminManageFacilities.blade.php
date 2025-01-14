<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Facilities - Sports Hall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/adminFacilities.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Success Notification -->
        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <form action="{{ route('admin.facility.store') }}" method="POST">
            @csrf
            <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-xl font-semibold">Close Venue</h2>
                <div class="flex justify-center space-x-4">
                    <!-- Venue Selection -->
                    <div class="flex items-center flex-grow">
                        <select name="venue" id="venueSelect" class="w-full px-4 py-2 text-black bg-white border border-gray-600 rounded shadow-md hover:bg-white-600" required>
                            <option value="" disabled selected>Select Venue</option>
                            <option value="UTM_BD">Badminton Court</option>
                            <option value="UTM_SW">Swimming Pool</option>
                            <option value="UTM_GY">Gym</option>
                            <option value="UTM_ST">Stadium</option>
                        </select>
                    </div>
                    <!-- Reason Selection -->
                    <div class="flex items-center flex-grow">
                        <select name="reason" id="reasonSelect" class="w-full px-4 py-2 text-black bg-white border border-gray-600 rounded shadow-md hover:bg-white-600" required>
                            <option value="" disabled selected>Occasions</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Booked">Booked</option>
                            <option value="Public Holiday">Public Holiday</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Block Date Section -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-xl font-semibold">Block Date</h2>
                <p class="mb-4 text-gray-700">Select the date range you want to block for bookings:</p>
                <div class="flex flex-col space-y-4">
                    <input type="date" name="start_date" id="startDateInput" class="w-full px-4 py-2 border border-gray-600 rounded shadow-md" required />
                    <input type="date" name="end_date" id="endDateInput" class="w-full px-4 py-2 border border-gray-600 rounded shadow-md" required />
                    <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded shadow-md hover:bg-blue-600">Submit</button>
                </div>
            </div>
        </form>
    </main>

    <script>
        // Set minimum date for start and end dates
        const today = new Date().toISOString().split('T')[0];
        const startDateInput = document.getElementById('startDateInput');
        const endDateInput = document.getElementById('endDateInput');

        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);

        // Ensure end_date cannot be less than start_date
        startDateInput.addEventListener('change', function () {
            endDateInput.setAttribute('min', this.value);
        });

        // Toggle the Admin Profile dropdown
        function toggleAdminProfileMenu() {
            const menu = document.getElementById('adminProfileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
