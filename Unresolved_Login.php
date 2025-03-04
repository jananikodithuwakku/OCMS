<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: C_Unresolved.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/Register.css">
</head>
<body>
<header>
        <div class="logo">
            <img src="Images/Logo.png" >
            <h1>Online Crime Management System</h1>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="Home.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <?php
        if(isset($_POST["login"])){
            $emai = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$emai'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                if(password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: C_Unresolved.php");
                    die();
                }
                else{
                    echo"<div class='alert alert-danger'>Password dose not match</div>";
                }
            }
            else{
                echo"<div class='alert alert-danger'>Email dose not match<div>";
            }
        }
        ?>
        <form action = "Unresolved_Login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email: " name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password: " name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" placeholder="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
            <div><P>Not registered yet <a href="Unresolved_Register.php">Register Here </a></P></div>
          </div>
    </div>
</body>
</html>