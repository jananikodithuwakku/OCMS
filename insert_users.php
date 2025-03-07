<?php
include 'database.php'; // Database connection

// Function to hash passwords using bcrypt
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// User credentials for testing
$users = [
    ['admin', 'admin123', 'admin'],
    ['police1', 'police123', 'police_officer'],
    ['support1', 'support123', 'support_personnel']
];

foreach ($users as $user) {
    $username = $user[0];
    $password = hashPassword($user[1]); // Hash password
    $role = $user[2];

    // Check if user already exists
    $checkUser = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO admin (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "User '$username' added successfully.<br>";
        } else {
            echo "Error: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "User '$username' already exists.<br>";
    }
}

mysqli_close($conn);
?>
