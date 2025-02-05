<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: Login.php");
    exit();
}

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $latitude = !empty($_POST['latitude']) ? mysqli_real_escape_string($conn, $_POST['latitude']) : NULL;
    $longitude = !empty($_POST['longitude']) ? mysqli_real_escape_string($conn, $_POST['longitude']) : NULL;

    // Handle file upload
    $evidence = "";
    if (!empty($_FILES["evidence"]["name"])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $evidence = $targetDir . basename($_FILES["evidence"]["name"]);
        move_uploaded_file($_FILES["evidence"]["tmp_name"], $evidence);
    }

    $sql = "INSERT INTO crime_reports (name, email, phone, location, latitude, longitude, date, description, evidence) 
            VALUES ('$name', '$email', '$phone', '$location', '$latitude', '$longitude', '$date', '$description', '$evidence')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Crime report submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Crime</title>
    <link rel="stylesheet" href="CSS/Report_Crime.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Images/Logo.png" alt="Online Crime Management System">
            <h1>Online Crime Management System</h1>
        </div>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Features.php">Features</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div id="google_translate_element"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en', includedLanguages: 'en,si,ta', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <main>
        <h2>Report Crime</h2>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="location">Location</label>
                <input type="text" id="location" name="location" required>

                <!-- Hidden Inputs for Latitude & Longitude -->
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">

                <label for="date">Date of Incident</label>
                <input type="date" id="date" name="date" required>

                <label for="description">Crime Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                <label for="evidence">Upload Evidence (if any)</label>
                <input type="file" id="evidence" name="evidence">

                <button type="submit">Submit Report</button>
            </form>
        </div>
    </main>

    <script>
        // Get User's Live Location
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
            getAddress(position.coords.latitude, position.coords.longitude);
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }

        // Reverse Geocode to Get Address
        function getAddress(lat, lon) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("location").value = data.display_name;
            })
            .catch(error => console.log("Error fetching address: ", error));
        }

        // Call getLocation when page loads
        window.onload = getLocation;
    </script>

    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
