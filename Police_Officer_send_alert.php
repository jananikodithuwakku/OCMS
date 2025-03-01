<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require 'database.php';

// Load PHPMailer
require 'vendor/autoload.php'; // If installed via Composer

$mail = new PHPMailer(true);

// Check if this request is citizen registration or crime alert trigger
if (isset($_POST['register'])) {
    // Citizen Registration: Store Email & Location in DB
    $email = $_POST['email']; 
    $latitude = $_POST['latitude']; 
    $longitude = $_POST['longitude']; 

    $sql = "INSERT INTO citizens (email, latitude, longitude) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdd", $email, $latitude, $longitude);

    if ($stmt->execute()) {
        echo '✅ Registration successful! You will receive alerts when crimes happen near you.';
    } else {
        echo '❌ Failed to register!';
    }
} elseif (isset($_POST['crime_alert'])) {
    // Officer-triggered crime alert
    $crime_latitude = $_POST['latitude'];
    $crime_longitude = $_POST['longitude'];

    // Find registered users near crime location (within 5 km)
    $sql = "SELECT email, latitude, longitude FROM citizens WHERE 
            (6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(latitude)) * 
            COS(RADIANS(longitude) - RADIANS(?)) + SIN(RADIANS(?)) * 
            SIN(RADIANS(latitude)))) <= 5";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddd", $crime_latitude, $crime_longitude, $crime_latitude);
    $stmt->execute();
    $result = $stmt->get_result();

    $google_maps_link = "https://www.google.com/maps?q={$crime_latitude},{$crime_longitude}";

    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];

        try {
            // SMTP Server Settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'kodithuwakkujanani@gmail.com'; // Replace with your email
            $mail->Password   = 'asna zhzz logq vwsz'; // Use Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Sender & Recipient Details
            $mail->setFrom('your-email@gmail.com', 'Crime Alert System');
            $mail->addAddress($email);

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = '🚨 Crime Alert Notification';
            $mail->Body    = "<h3>A crime has been reported near your location. Stay alert and report any suspicious activity!</h3>
                              <p><strong>Location:</strong> <a href='{$google_maps_link}' target='_blank'>View on Google Maps</a></p>";
            $mail->AltBody = "A crime has been reported near your location. Stay alert! Location: {$google_maps_link}";

            // Send Email
            $mail->send();
        } catch (Exception $e) {
            echo "❌ Email Error: {$mail->ErrorInfo}";
        }
    }

    echo '✅ Crime alerts sent successfully!';
}
?>