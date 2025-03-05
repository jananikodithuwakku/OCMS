<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: Report_Crime.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Online Crime Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Register.css">
    <style>
        body {
            background-color: #001f3d;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group input {
            background: transparent;
            color: white;
            border: 1px solid white;
        }

        .form-group input::placeholder {
            color: #ddd;
        }

        .form-btn {
            text-align: center;
        }

        .form-btn input {
            width: 100%;
            background: #ffcc00;
            border: none;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            color: black;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        .form-btn input:hover {
            background: #e6b800;
        }

        .alert {
            text-align: center;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #ffcc00;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>User Register</h2>

        <?php
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();

            if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Passwords do not match");
            }

            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                array_push($errors, "Email already exists!");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                } else {
                    die("Something went wrong.");
                }
            }
        }
        ?>

        <form action="Register.php" method="post">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>
            <div class="form-btn mb-3">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>

        <div class="login-link">
            <p>Already Registered? <a href="Login.php">Login Here</a></p>
        </div>
    </div>

</body>
</html>
