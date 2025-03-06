<?php
session_start();
if (isset($_SESSION["email"])) {
    header("Location: citizen_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Register.css">
</head>
<body>
    <div class="background">
        <div class="login-container">
            <h2>User Login</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
                require_once "database.php";

                $email = trim($_POST["email"]);
                $password = trim($_POST["password"]);

                // Check if email is empty
                if (empty($email) || empty($password)) {
                    echo "<p class='error-msg'>⚠️ Email and Password are required!</p>";
                } else {
                    // Secure the query using prepared statements
                    $sql = "SELECT * FROM users WHERE email = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $user = mysqli_fetch_assoc($result);

                    if ($user) {
                        if (password_verify($password, $user["password"])) {
                            // ✅ Set the session variable with the email
                            $_SESSION["email"] = $user["email"];
                            header("Location: citizen_dashboard.php");
                            exit();
                        } else {
                            echo "<p class='error-msg'>⚠️ Incorrect Password</p>";
                        }
                    } else {
                        echo "<p class='error-msg'>⚠️ Email Not Found</p>";
                    }
                }
            }
            ?>

            <form action="Citi_Dash_Login.php" method="post">
                <div class="input-group">
                    <input type="email" placeholder="Enter Email" name="email" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Enter Password" name="password" required>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
