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
    <title>Add FAQs</title>
    
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #141e30, #243b55);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .faq-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 400px;
            backdrop-filter: blur(10px);
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
            background: #0f2027;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #01a9db;
        }

        /* Responsive Design */
        @media (max-width: 400px) {
            .faq-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
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
