<?php
include 'database.php'; // Ensure database connection is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully!'); window.location.href='Contact.php';</script>";
        } else {
            echo "<script>alert('Error sending message.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('All fields are required!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Online Crime Management System</title>
    <link rel="stylesheet" href="CSS/Contact.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Font Awesome for Icons -->
</head>
<body>
    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="logo">
            <img src="Images/Logo.png" alt="OCMS Logo">
            <span>Online Crime Management System</span>
        </div>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Contact.php" class="active">Contact</a></li>
                <li><a href="Features.php">Features</a></li>
                <li><a href="Login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contact Section -->
    <section class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>If you have any queries, feel free to reach out to us.</p>

           

            <!-- Contact Form -->
            <div class="contact-form">
                <form action="Contact.php" method="POST">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
     <!-- Contact Details -->
     <div class="contact-details">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p><strong>Address:</strong> 123 Crime Prevention St, Colombo, Sri Lanka</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <p><strong>Phone:</strong> +94 77 123 4567</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <p><strong>Email:</strong> support@ocms.lk</p>
                </div>
            </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
