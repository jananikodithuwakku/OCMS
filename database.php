<?php
// Enable error reporting to help debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$hostName = "localhost:3307";  // Change port if needed
$dbUser = "root";
$dbPassword = "";
$dbName = "ocms";

// Create connection
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
