<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keywords = $_POST["keywords"];
    $answer = $_POST["answer"];

    $stmt = $conn->prepare("INSERT INTO faqs (keywords, answer) VALUES (?, ?)");
    $stmt->bind_param("ss", $keywords, $answer);

    if ($stmt->execute()) {
        echo "FAQ added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add FAQs</title>
</head>
<body>
    <h2>Add New FAQ</h2>
    <form method="POST">
        <label>Keywords:</label><br>
        <input type="text" name="keywords" required><br><br>
        <label>Answer:</label><br>
        <textarea name="answer" required></textarea><br><br>
        <button type="submit">Add FAQ</button>
    </form>
</body>
</html>
