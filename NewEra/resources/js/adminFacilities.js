$('#blockDateButton').click(function () {
    const venue = $('#venueSelect').val();
    const reason = $('#reasonSelect').val();
    const date = $('#blockDateInput').val();

    if (venue && reason && date) {
        const venueData = { venue, reason, date };
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        fetch('/admin/close-venue', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(venueData),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    Swal.fire('Success', data.message, 'success');
                } else {
                    Swal.fire('Error', data.message || 'Failed to close venue.', 'error');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                Swal.fire('Error', 'An unexpected error occurred.', 'error');
            });
    } else {
        Swal.fire('Error', 'All fields are required.', 'error');
    }
});