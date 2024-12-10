
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    .booking-row {
        display: table-row;
    }
    </style>

    <script>
        function filterBookings(filter) {
            console.log("Filtering by:", filter);
            const rows = document.querySelectorAll(".booking-row");
            const now = new Date();
            const currentMonth = now.getMonth();
            const currentYear = now.getFullYear();
            const semesterStartFall = new Date(currentYear, 8, 1); // September 1st (Fall semester start)
            const semesterEndFall = new Date(currentYear, 11, 31); // December 31st (Fall semester end)
            const semesterStartSpring = new Date(currentYear, 0, 1); // January 1st (Spring semester start)
            const semesterEndSpring = new Date(currentYear, 4, 31); // May 31st (Spring semester end)

            rows.forEach((row) => {
                const bookingDate = new Date(row.dataset.date);
                let show = false;

                if (isNaN(bookingDate)) return;

                if (filter === "thisWeek") {
                    const oneWeekAgo = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7);
                    show = bookingDate >= oneWeekAgo && bookingDate <= now;
                } else if (filter === "thisMonth") {
                    show = bookingDate.getMonth() === currentMonth && bookingDate.getFullYear() === currentYear;
                } else if (filter === "thisSemester") {
                    if (
                        (bookingDate >= semesterStartFall && bookingDate <= semesterEndFall) ||
                        (bookingDate >= semesterStartSpring && bookingDate <= semesterEndSpring)
                    ) {
                        show = true;
                    }
                } else if (filter === "allTime") {
                    show = true;
                }

                row.style.display = show ? "" : "none";
            });
        }

        function searchBookings() {
            const searchBar = document.getElementById("search-bar");
            const query = searchBar.value.toLowerCase().trim();
            const rows = document.querySelectorAll(".booking-row");
            const noResultsMessage = document.getElementById("no-results-message");

            if (!query) {
                noResultsMessage.style.display = "block";
                noResultsMessage.textContent = "Please type something to search!";
                rows.forEach((row) => (row.style.display = "none"));
                return;
            }

            let found = false;

            rows.forEach((row) => {
                const cells = row.querySelectorAll("td");
                const rowText = Array.from(cells)
                    .map((cell) => cell.textContent.toLowerCase())
                    .join(" ");
                const match = rowText.includes(query);
                row.style.display = match ? "" : "none";
                if (match) found = true;
            });

            noResultsMessage.style.display = found ? "none" : "block";
            noResultsMessage.textContent = found ? "" : "No results found. Please try another search.";
        }

        function resetSearch() {
            const rows = document.querySelectorAll(".booking-row");
            document.getElementById("search-bar").value = "";
            rows.forEach((row) => (row.style.display = ""));
            document.getElementById("no-results-message").style.display = "none";
        }
    </script>
</head>
<body class="bg-gray-50">

<nav class="bg-white shadow-md">
    <div class="container mx-auto flex items-center justify-between px-4 py-4">
        <!-- Link to Main Page -->
        <a href="{{ route('mainpage') }}" class="flex items-center">
            <img src="{{ asset('UTM-LOGO-FULL.png') }}" alt="UTM Logo" class="h-8 md:h-10" />
        </a>
        <div></div>
    </div>
</nav>

<main class="min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-center text-2xl font-bold mb-6">BOOKING HISTORY</h2>

        <div class="flex items-center justify-center space-x-4 mb-6">
            <!-- Search Bar -->
            <input 
                id="search-bar" 
                type="text" 
                placeholder="Search by date, receipt number..." 
                class="w-full max-w-lg border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:ring focus:ring-indigo-300" 
            />
            
            <!-- Search Button -->
            <button 
                class="bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 focus:outline-none"
                onclick="searchBookings()"
            >
                Search
            </button>
            
            <!-- Reset Button -->
            <button 
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 focus:outline-none"
                onclick="resetSearch()"
            >
                Reset
            </button>

            <!-- Filter Dropdown Button -->
            <div class="relative">
                <button 
                    id="filter-button" 
                    class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 focus:outline-none flex items-center space-x-2"
                    onclick="toggleFilterDropdown()"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 01.8 1.6L12 10.4V15a1 1 0 01-.553.894l-4 2A1 1 0 016 17v-6.6L3.2 6.6A1 1 0 013 5z" clip-rule="evenodd" />
                    </svg>
                    <span>Filter</span>
                </button>

                <!-- Dropdown Menu -->
                <div id="filter-dropdown" class="hidden absolute bg-white border border-gray-200 rounded-lg shadow-lg p-4 mt-2 z-10">
                    <button 
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        onclick="filterBookings('thisWeek')"
                    >
                        This Week
                    </button>
                    <button 
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        onclick="filterBookings('thisMonth')"
                    >
                        This Month
                    </button>
                    <button 
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        onclick="filterBookings('thisSemester')"
                    >
                        This Semester
                    </button>
                    <button 
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        onclick="filterBookings('allTime')"
                    >
                        All Time
                    </button>
                </div>
            </div>
        </div>

        <!-- Table and No Results Message Here -->

    </div>


        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-gray-600 font-medium">BOOKING DATE</th>
                    <th class="px-6 py-4 text-left text-gray-600 font-medium">RECEIPT NO.</th>
                    <th class="px-6 py-4 text-left text-gray-600 font-medium">PAYMENT STATUS</th>
                    <th class="px-6 py-4 text-left text-gray-600 font-medium">SPORTS FACILITY</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-10-02">
                    <td class="px-6 py-4">2024-10-02</td>
                    <td class="px-6 py-4">RCP-10001</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Sports Hall</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-11-01">
                    <td class="px-6 py-4">2024-11-01</td>
                    <td class="px-6 py-4">RCP-10007</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Swimming Pool</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-10-02">
                    <td class="px-6 py-4">2024-10-02</td>
                    <td class="px-6 py-4">RCP-10001</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Gymnasium</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-10-04">
                    <td class="px-6 py-4">2024-10-04</td>
                    <td class="px-6 py-4">RCP-10002</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Field</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-10-07">
                    <td class="px-6 py-4">2024-10-07</td>
                    <td class="px-6 py-4">RCP-10003</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Sports Hall</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-10-10">
                    <td class="px-6 py-4">2024-10-10</td>
                    <td class="px-6 py-4">RCP-10004</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Swimming Pool</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-10-14">
                    <td class="px-6 py-4">2024-10-14</td>
                    <td class="px-6 py-4">RCP-10005</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Gymnasium</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-10-20">
                    <td class="px-6 py-4">2024-10-20</td>
                    <td class="px-6 py-4">RCP-10006</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Field</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="202

4-11-01">
                    <td class="px-6 py-4">2024-11-01</td>
                    <td class="px-6 py-4">RCP-10007</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Sports Hall</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-11-08">
                    <td class="px-6 py-4">2024-11-08</td>
                    <td class="px-6 py-4">RCP-10008</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Swimming Pool</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-11-15">
                    <td class="px-6 py-4">2024-11-15</td>
                    <td class="px-6 py-4">RCP-10009</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Gymnasium</td>
                </tr>
                <tr class="hover:bg-gray-50 booking-row" data-date="2024-11-18">
                    <td class="px-6 py-4">2024-11-18</td>
                    <td class="px-6 py-4">RCP-10010</td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Paid</td>
                    <td class="px-6 py-4">Field</td>
                </tr>
            </tbody>
        </table>

        <p id="no-results-message" class="text-center text-red-600 font-bold mt-4" style="display: none;">
            No results found. Please try another search.
        </p>
    </div>
</main>

<footer class="bg-white shadow-md py-4 mt-8"></footer>

</body>
</html>
