<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Booking Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen text-gray-800 bg-gray-100">
    <main class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-2xl font-bold text-center">Admin Booking Management</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($bookings as $booking)
            <div class="p-4 bg-white border rounded shadow-md">
                <h2 class="text-lg font-semibold">Booking ID: {{ $booking['_id'] }}</h2>
                <p>Venue: {{ $booking['venue'] ?? 'N/A' }}</p>
                <p>Date: {{ $booking['date'] ?? 'N/A' }}</p>
                <p>Time: {{ $booking['time'] ?? 'N/A' }}</p>
                <p>Status: {{ $booking['status'] ?? 'Pending' }}</p>
                <div class="flex items-center mt-4">
                    <input type="checkbox" class="mr-2 bookingCheckbox" data-id="{{ $booking['_id'] }}">
                    <label>Confirm Attendance</label>
                </div>
            </div>
        @empty
            <p>No bookings found.</p>
        @endforelse

        </div>
        <div class="mt-6 text-right">
            <button id="updateButton" class="px-4 py-2 text-white bg-green-500 rounded shadow hover:bg-green-600">
                Update Selected
            </button>
        </div>
    </main>

    <script>
        // Handle update selected bookings
        document.getElementById('updateButton').addEventListener('click', () => {
            const selectedBookings = Array.from(document.querySelectorAll('.bookingCheckbox:checked')).map(cb => cb.dataset.id);

            if (selectedBookings.length > 0) {
                Swal.fire({
                    title: 'Confirm Update',
                    text: "Are you sure you want to confirm attendance for the selected bookings?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make an AJAX call to update the bookings
                        $.ajax({
                            url: '/update-bookings',
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                bookingIds: selectedBookings
                            },
                            success: (response) => {
                                Swal.fire('Updated!', response.message, 'success').then(() => location.reload());
                            },
                            error: (error) => {
                                Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
                            }
                        });
                    }
                });
            } else {
                Swal.fire('Error!', 'Please select at least one booking to update.', 'error');
            }
        });
    </script>
</body>
</html>
