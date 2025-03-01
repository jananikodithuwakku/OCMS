<?php
require 'database.php';

if (isset($_GET['case_id'])) {
    $case_id = $_GET['case_id'];

    $query = "UPDATE cases SET status = 'Under Investigation', escalation_requested = 0 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $case_id);

    if ($stmt->execute()) {
        echo "Case escalation resolved.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<a href="police_ES_dashboard.php">Back to Dashboard</a>
