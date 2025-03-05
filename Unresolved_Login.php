<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: C_Unresolved.php");
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
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("Location: C_Unresolved.php");
                        die();
                    } else {
                        echo "<p class='error-msg'>⚠️ Incorrect Password</p>";
                    }
                } else {
                    echo "<p class='error-msg'>⚠️ Email Not Found</p>";
                }
            }
            ?>
            <form action="Unresolved_Login.php" method="post">
                <div class="input-group">
                    <input type="email" placeholder="Enter Email" name="email" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Enter Password" name="password" required>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
            <p class="register-text">Not registered yet? <a href="Unresolved_Register.php">Register Here</a></p>
        </div>
    </div>
</body>
</html>
