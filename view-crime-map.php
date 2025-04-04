<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Map of Sri Lanka</title>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        nav {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        nav ul li a:hover {
            color: #0056b3;
        }

        #map { height: 600px; width: 100%; }
        /* Legend Styles */
        .legend {
            position: absolute;
            bottom: 30px;
            right: 30px;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
            font-size: 14px;
        }
        .legend i {
            width: 18px;
            height: 18px;
            display: inline-block;
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <h1>Crime Map of Sri Lanka</h1>

    <nav>
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Features.php">Features</a></li>
            <li><a href="Type_Crime.php">Types of Crimes</a></li>
        </ul>
    </nav>

    <div id="map"></div>

    

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Initialize the map
        var map = L.map('map').setView([7.8731, 80.7718], 7);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Function to assign colors based on crime rate
        function getColor(crimeCount) {
            return crimeCount > 1000 ? '#660000' :
                   crimeCount > 750  ? '#990000' :
                   crimeCount > 500  ? '#CC3300' :
                   crimeCount > 250  ? '#FF6600' :
                   crimeCount > 150  ? '#FFCC00' :
                                      '#FFFF66';
        }

        // Load GeoJSON file
        fetch('crime.geojson')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: function(feature) {
                        var crimeCount = feature.properties.crime_data_total_crimes || 0;
                        return {
                            fillColor: getColor(crimeCount),
                            weight: 1,
                            opacity: 1,
                            color: 'white',
                            fillOpacity: 0.7
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        var district = feature.properties.DISTRICT || "Unknown";
                        var crimes = feature.properties.crime_data_total_crimes || 0;

                        // Bind popup to each district
                        layer.bindPopup(`<b>${district}</b><br>Total Crimes: ${crimes}`);

                        // Calculate district center and add label
                        if (feature.geometry.type === "MultiPolygon") {
                            var coords = feature.geometry.coordinates[0][0];
                            var latSum = 0, lonSum = 0;
                            coords.forEach(coord => {
                                lonSum += coord[0];
                                latSum += coord[1];
                            });
                            var centerLat = latSum / coords.length;
                            var centerLon = lonSum / coords.length;

                            // Add district label
                            L.marker([centerLon, centerLat], {
                                icon: L.divIcon({
                                    className: 'district-label',
                                    html: `<div style="font-size: 12px; font-weight: bold; color: black; text-shadow: 1px 1px 2px white;">${district}</div>`,
                                    iconSize: [50, 20]
                                })
                            }).addTo(map);
                        }
                    }
                }).addTo(map);
            })
            .catch(error => console.error('Error loading GeoJSON:', error));

        // Add legend to the map
        var legend = L.control({ position: "bottomright" });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create("div", "legend");
            div.innerHTML += "<b>Crime Levels</b><br>";
            div.innerHTML += '<i style="background:rgb(36, 3, 3)"></i> > 1000 crimes<br>';
            div.innerHTML += '<i style="background:rgb(129, 8, 8)"></i> 750 - 1000 crimes<br>';
            div.innerHTML += '<i style="background:rgb(146, 49, 17)"></i> 500 - 750 crimes<br>';
            div.innerHTML += '<i style="background:rgb(187, 86, 18)"></i> 250 - 500 crimes<br>';
            div.innerHTML += '<i style="background:rgb(194, 159, 22)"></i> 150 - 250 crimes<br>';
            div.innerHTML += '<i style="background:rgb(214, 214, 17)"></i> < 150 crimes<br>';
            return div;
        };

        legend.addTo(map);

    </script>

</body>
</html>
