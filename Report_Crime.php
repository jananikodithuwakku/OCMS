<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Crime</title>
    <link rel="stylesheet" href="CSS/Report_Crime.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Images/Logo.png" alt="Online Crime Management System">
            <h1>Online Crime Management System</h1>
        </div>
        <nav>
            <ul>
                <li><a href="Home.html">Home</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Report Crime</h2>
        <div class="form-container">
            <form action="submit_crime.php" method="POST" enctype="multipart/form-data">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="location">Location</label>
                <input type="text" id="location" name="location" required>

                <label for="date">Date of Incident</label>
                <input type="date" id="date" name="date" required>

                <label for="description">Crime Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                <label for="evidence">Upload Evidence (if any)</label>
                <input type="file" id="evidence" name="evidence">

                <button type="submit">Submit Report</button>
            </form>
        </div>
    </main>
    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
