<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Crime Map</title>
    <link rel="stylesheet" href="CSS/view-crime-map.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Logo.png" alt="Logo">
        </div>
        <h1>Crime Map</h1>
        <nav>
            <ul class="navbar">
                <li><a href="Home.html">Home</a></li>
                <li><a href="view-complaints.html">View Complaints</a></li>
                <li><a href="help-center.html">Help Center</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="map-container">
        <h2>Crime Hotspots</h2>
        <div id="map"></div>
    </section>

    <footer>
        <p>For assistance, visit our <a href="help-center.html">Help Center</a>.</p>
    </footer>

    <script>
        function initMap() {
            var mapOptions = {
                center: { lat: 37.7749, lng: -122.4194 }, // Default location: San Francisco
                zoom: 12
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var crimeLocations = [
                { lat: 37.7749, lng: -122.4194, type: "Theft" },
                { lat: 37.7849, lng: -122.4294, type: "Assault" },
                { lat: 37.7649, lng: -122.4094, type: "Robbery" }
            ];

            crimeLocations.forEach(function(location) {
                var marker = new google.maps.Marker({
                    position: { lat: location.lat, lng: location.lng },
                    map: map,
                    title: location.type
                });
            });
        }

        window.onload = initMap;
    </script>
</body>
</html>
