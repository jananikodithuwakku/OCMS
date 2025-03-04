<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: C_Unresolves.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form </title>
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
        if(isset($_POST["submit"])){
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(empty( $fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
                array_push($errors, "All fields are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email is not valid");
            }
            if(strlen($password)<8){
                array_push($errors, "Password must be at least 8 charactes long");
            }
            if($password!==$passwordRepeat){
                array_push($errors, "Password dose not match");
            }
            require_once "database.php" ; 
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors,"Email already exists!");
            }


            if(count($errors)>0 ){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error<?div>";
                }
            }
            else{
                require_once "database.php" ;  
                $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are Registered Successfully.</div>";

                }   
                else{
                    die("Something went wrong.");
                }         
            }
        }
        ?>
        <form action="Unresolved_Register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
          <div>
            <div><P>Already Registered <a href="Unresolved_Login.php">Login Here </a></P></div>
          </div>
    </div> 
</body>
</html>