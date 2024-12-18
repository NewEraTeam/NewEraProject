<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - UTM Sports Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom CSS */
        .profile-container {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            min-height: 100vh;
        }

        .sidebar {
            background: linear-gradient(to bottom, #1a237e, #283593);
            color: white;
            transition: all 0.3s ease;
        }

        .sidebar a {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 4px 0;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .profile-header {
            background: linear-gradient(to right, #fff, #f8f9fa);
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-image {
            border: 4px solid #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .booking-table {
            border-radius: 12px;
            overflow: hidden;
        }

        .booking-table th {
            background: #1a237e;
            color: white;
            font-weight: 500;
        }

        .booking-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .booking-table tr:hover {
            background-color: #e9ecef;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .action-button {
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content-area {
                margin-left: 0;
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="profile-container">
    <div class="container mx-auto">
        <!-- Sidebar Navigation -->
        <div class="flex">
            <div class="sidebar w-64 h-screen shadow-lg">
                <div class="p-4">
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                    <nav class="mt-6">
                        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-500 hover:text-white">Profile</a>
                        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-500 hover:text-white">My Bookings</a>
                        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-500 hover:text-white">Facilities</a>
                        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-500 hover:text-white">Settings</a>
                        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-500 hover:text-white">Logout</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="content-area flex-1 p-8">
                <!-- Profile Header -->
                <div class="profile-header p-6 mb-6">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/100" alt="Profile" class="profile-image w-24 h-24 rounded-full">
                        <div class="ml-6">
                            <h1 class="text-2xl font-bold">{{ $user->name ?? 'User Name' }}</h1>
                            <p class="text-gray-600">{{ $user->email ?? 'user@email.com' }}</p>
                            <p class="text-gray-600">Member since: {{ $user->created_at ?? 'Date' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Overview -->
                <div class="stats-grid grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="stats-card p-6">
                        <h3 class="text-lg font-semibold mb-2">Total Bookings</h3>
                        <p class="text-3xl font-bold">{{ $totalBookings ?? '0' }}</p>
                    </div>
                    <div class="stats-card p-6">
                        <h3 class="text-lg font-semibold mb-2">Active Bookings</h3>
                        <p class="text-3xl font-bold">{{ $activeBookings ?? '0' }}</p>
                    </div>
                    <div class="stats-card p-6">
                        <h3 class="text-lg font-semibold mb-2">Favorite Facility</h3>
                        <p class="text-3xl font-bold">{{ $favoriteFacility ?? 'None' }}</p>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="booking-table bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Recent Bookings</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 text-left">Facility</th>
                                    <th class="px-6 py-3 text-left">Date</th>
                                    <th class="px-6 py-3 text-left">Time</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                    <th class="px-6 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings ?? [] as $booking)
                                <tr class="border-b">
                                    <td class="px-6 py-4">{{ $booking->facility_name }}</td>
                                    <td class="px-6 py-4">{{ $booking->date }}</td>
                                    <td class="px-6 py-4">{{ $booking->time }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-sm
                                            {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' :
                                               ($booking->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
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
    </div>
</body>
</html>