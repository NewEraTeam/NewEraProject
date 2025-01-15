<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Filter Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <h1 class="mb-6 text-2xl font-bold text-center">Admin Booking Management</h1>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold">View and Manage Bookings</h2>
            <table class="w-full text-left border border-collapse border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border border-gray-300">Select</th>
                        <th class="px-4 py-2 border border-gray-300">Booking ID</th>
                        <th class="px-4 py-2 border border-gray-300">Venue</th>
                        <th class="px-4 py-2 border border-gray-300">Date</th>
                        <th class="px-4 py-2 border border-gray-300">Time</th>
                        <th class="px-4 py-2 border border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody id="bookingTableBody">
                    <!-- Booking rows will be dynamically added here -->
                    {{-- <tr>
                        <td class="px-4 py-2 text-center border border-gray-300">
                            <input type="checkbox" class="bookingCheckbox" />
                        </td>
                        <td class="px-4 py-2 border border-gray-300">B001</td>
                        <td class="px-4 py-2 border border-gray-300">Badminton Court</td>
                        <td class="px-4 py-2 border border-gray-300">2025-01-15</td>
                        <td class="px-4 py-2 border border-gray-300">10:00 AM - 12:00 PM</td>
                        <td class="px-4 py-2 border border-gray-300">Confirmed</td>
                    </tr> --}}
                </tbody>
            </table>
            <div class="flex justify-end mt-4">
                <button id="updateButton" class="px-4 py-2 text-white bg-green-500 rounded shadow-md hover:bg-green-600">Update Selected</button>
            </div>
        </div>
    </main>

    <script>
        // Toggle the Admin Profile dropdown
        function toggleAdminProfileMenu() {
            const menu = document.getElementById('adminProfileMenu');
            menu.classList.toggle('hidden');
        }

        // Add filter functionality (example for demonstration purposes)
        document.getElementById('filterButton').addEventListener('click', () => {
            // Fetch bookings based on filter (implement backend logic to return filtered data)
            Swal.fire('Filter Applied', 'Bookings are filtered based on your selection.', 'success');
        });

        // Handle update selected bookings
        document.getElementById('updateButton').addEventListener('click', () => {
            const selectedBookings = Array.from(document.querySelectorAll('.bookingCheckbox:checked'));

            if (selectedBookings.length > 0) {
                Swal.fire('Success', 'Selected bookings updated successfully.', 'success');
            } else {
                Swal.fire('Error', 'Please select at least one booking to update.', 'error');
            }
        });
    </script>

</body>
</html>
