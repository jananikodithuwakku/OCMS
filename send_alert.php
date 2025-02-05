<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'vendor/autoload.php'; // If installed via Composer
// require 'PHPMailer/src/PHPMailer.php'; // Uncomment if manually installed
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP Server Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Change this if using another provider
    $mail->SMTPAuth   = true;
    $mail->Username   = 'kodithuwakkujanani@gmail.com'; // Replace with your email
    $mail->Password   = 'asna zhzz logq vwsz'; // Replace with your email password or app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; // Common SMTP port

    // Sender & Recipient Details
    $mail->setFrom('your-email@gmail.com', 'Crime Alert System'); // Sender
    $mail->addAddress('recipient-email@gmail.com'); // Recipient

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = '🚨 Crime Alert Notification';
    $mail->Body    = '<h3>A crime has been reported near your location. Stay alert and report any suspicious activity!</h3>';
    $mail->AltBody = 'A crime has been reported near your location. Stay alert and report any suspicious activity!';

    // Send Email
    if ($mail->send()) {
        echo '✅ Email sent successfully!';
    } else {
        echo '❌ Email sending failed!';
    }
} catch (Exception $e) {
    echo "❌ Error: {$mail->ErrorInfo}";
}
?>
