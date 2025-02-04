document.getElementById('enable-location').addEventListener('click', function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            // Send this information to your server or API to get alerts
            // Example: Fetch nearby incidents based on geolocation
            fetchAlerts(lat, lon);
        }, function(error) {
            alert('Geolocation failed. Please enable location services.');
        });
    } else {
        alert('Geolocation is not supported by this browser.');
    }
});

function fetchAlerts(latitude, longitude) {
    // Here you would connect to a backend that sends alerts based on location
    const alertMessage = `You are located at Lat: ${latitude}, Lon: ${longitude}. You will receive alerts for nearby incidents.`;
    document.getElementById('alert-message').innerText = alertMessage;
}
