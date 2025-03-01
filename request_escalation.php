<?php
require 'database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $case_id = $_POST['case_id'];
    $reason = $_POST['reason'];

    $query = "UPDATE cases SET escalation_requested = 1, escalation_reason = ? WHERE id = ? AND status = 'Unresolved'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $reason, $case_id);
    
    if ($stmt->execute()) {
        echo "Escalation request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Case Escalation</title>
</head>
<body>
    <h2>Request Escalation</h2>
    <form method="POST">
        <label for="case_id">Case ID:</label>
        <input type="number" name="case_id" required><br>

        <label for="reason">Reason for Escalation:</label>
        <textarea name="reason" required></textarea><br>

        <button type="submit">Request Escalation</button>
    </form>
</body>
</html>
