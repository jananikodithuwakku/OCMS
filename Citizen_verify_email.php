<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION["email"] ?? null;
    $entered_otp = $_POST["otp"] ?? '';

    if (!$email) {
        die("Unauthorized access. Please log in.");
    }

    // Fetch the OTP and expiry time from the database
    $query = "SELECT otp_code, otp_expires_at FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        $error = "User not found.";
    } elseif ($user['otp_expires_at'] < time()) {
        $error = "OTP has expired. Please request a new one.";
    } elseif ($user['otp_code'] !== $entered_otp) {
        $error = "Invalid OTP. Please try again.";
    } else {
        // Mark email as verified and remove OTP
        $update_query = "UPDATE users SET is_verified = 1, otp_code = NULL, otp_expires_at = NULL WHERE email = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, "s", $email);
        mysqli_stmt_execute($update_stmt);

        $_SESSION["message"] = "Email successfully verified!";
        header("Location: citizen_dashboard.php");
        exit();
    }
}
?>


