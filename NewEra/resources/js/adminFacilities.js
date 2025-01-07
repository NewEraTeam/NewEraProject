<script>
    $(document).ready(function() {
        $('#blockDateButton').click(function() {
            const venue = $('#venueSelect').val();
            const reason = $('#reasonSelect').val();
            const date = $('#blockDateInput').val();

            if (venue && reason && date) {
                const venueData = {
                    venue: venue,
                    reason: reason,
                    date: date
                };

                const csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token

                fetch('/admin/close-venue', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(venueData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Venue closed successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            } else {
                Swal.fire({
                    title: 'Validation Error',
                    text: 'Please select a venue, reason, and date.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>
