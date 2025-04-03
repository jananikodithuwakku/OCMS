<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keywords = $_POST["keywords"];
    $answer = $_POST["answer"];

    $stmt = $conn->prepare("INSERT INTO faqs (keywords, answer) VALUES (?, ?)");
    $stmt->bind_param("ss", $keywords, $answer);

    if ($stmt->execute()) {
        $message = "FAQ added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Add FAQs</title>
    
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(112, 119, 129);
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #0A1931;
            padding-top: 20px;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .logo img {
            width: 120px;
        }

        .sidebar a {
            display: block;
            color: #ffffff;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #1B2C53;
        }

        /* Main Content */
        .faq-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
            text-align: center;
            width: 400px;
            backdrop-filter: blur(10px);
            margin: auto;
            position: relative;
            top: 50px;
        }

        /* Heading */
        .faq-container h2 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Form Labels */
        label {
            color: #fff;
            font-size: 14px;
            display: block;
            margin-top: 10px;
            text-align: left;
        }

        /* Input Fields */
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 16px;
            outline: none;
        }

        input::placeholder, textarea::placeholder {
            color: #ddd;
        }

        /* Textarea Styling */
        textarea {
            height: 100px;
            resize: none;
        }

        /* Button Styling */
        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background: #01a9db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0288d1;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .faq-container {
                width: 90%;
            }
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="Images/Logo.png" alt="Logo">
        </div>
        <a href="support_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="Support_add_faq.php"><i class="fas fa-robot"></i> Chatbot Update</a>
        <a href="Support_Analytics.php"><i class="fas fa-envelope"></i> Contact Messages</a>
        <a href="Admin_Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="faq-container">
        <h2>Add New FAQ</h2>
        
        <?php if (isset($message)) echo "<p style='color: #fff; font-weight: bold;'>$message</p>"; ?>
        
        <form method="POST">
            <label>Keywords:</label>
            <input type="text" name="keywords" required placeholder="Enter keywords">
            
            <label>Answer:</label>
            <textarea name="answer" required placeholder="Enter answer"></textarea>
            
            <button type="submit">Add FAQ</button>
        </form>
    </div>
</body>
</html>
