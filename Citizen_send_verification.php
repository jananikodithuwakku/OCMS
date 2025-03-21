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
    $otp_message = "OTP sent to your email.";
} catch (Exception $e) {
    $otp_message = "Failed to send OTP. Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }

        #verifyButton {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease-in-out;
        }

        #verifyButton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Your OTP</h2>
        <form action="Citizen_verify_email.php" method="post">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <button type="submit" name="verifyButton" id="verifyButton">Verify</button>
        </form>
    </div>
</body>
</html>


</body>
</html>
