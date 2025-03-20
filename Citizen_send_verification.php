<?php
session_start();
include 'database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

if (!isset($_SESSION["email"])) {
    header("Location: Citi_Dash_Login.php");
    exit();
}

$user_email = $_SESSION["email"];
$otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Generate 6-digit OTP
$otp_expiry = date("Y-m-d H:i:s", strtotime("+5 minutes")); // OTP valid for 5 minutes

// Store OTP in database
$query = "UPDATE users SET otp_code = ?, otp_expires_at = ? WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sss", $otp, $otp_expiry, $user_email);
mysqli_stmt_execute($stmt);

// Send OTP via email
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kodithuwakkujanani@gmail.com'; 
    $mail->Password = 'asna zhzz logq vwsz'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('your_email@gmail.com', 'OCMS Support');
    $mail->addAddress($user_email);

    $mail->isHTML(true);
    $mail->Subject = 'Your OTP for Email Verification';
    $mail->Body = "Your OTP for email verification is: <b>$otp</b>. It expires in 5 minutes.";

    $mail->send();
    echo "OTP sent to your email.";
} catch (Exception $e) {
    echo "Failed to send OTP. Error: {$mail->ErrorInfo}";
}
?>
<form action="Citizen_verify_email.php" method="post">
    <!-- Your OTP input fields go here -->
    <button type="submit" name="verifyButton" id="verifyButton">Verify</button>
</form>
