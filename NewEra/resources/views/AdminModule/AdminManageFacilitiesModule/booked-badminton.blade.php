<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Badminton</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Booked Badminton</h1>

        <!-- Search and Sort Form -->
        <form method="GET" action="{{ url('booked-badminton') }}" class="mb-4">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Search Booking ID, Matric Number, or Court"
                           value="{{ $search }}">
                </div>
                <div class="col-md-4">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>Sort by Date: Ascending</option>
                        <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Sort by Date: Descending</option>
                    </select>
                </div>
            </div>
        </form>

        <!-- Bookings Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Booking ID</th>
                        <th>Matric Number</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Court</th>
                        <th>Payment Status</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking['booking_id'] }}</td>
                            <td>{{ $booking['matric_number'] }}</td>
                            <td>{{ $booking['date'] }}</td>
                            <td>{{ $booking['start_time'] }}</td>
                            <td>{{ $booking['end_time'] }}</td>
                            <td>{{ $booking['court'] }}</td>
                            <td>{{ $booking['payment_status'] }}</td>
                            <td>{{ $booking['total_price'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No bookings found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
