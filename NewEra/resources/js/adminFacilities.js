$(document).ready(function() {
    $('#venueSelectButton').click(function() {
        const venue = $('#venueSelect').val();
        const reason = $('#reasonSelect').val();
        const date = $('#blockDateInput').val();

        if (venue && reason && date) {
            const venueData = {
                venue: venue,
                reason: reason,
                date: date
            };

            fetch('/api/close-venue', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(venueData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) { 
                    alert('Venue closed successfully!'); 
                } else {
                    alert('Error closing venue: ' + data.message); 
                }
            })
            .catch(error => {
                alert('Error closing venue: ' + error.message);
            });
        } else {
            alert('Please select a venue, reason, and date.');
        }
    });
});