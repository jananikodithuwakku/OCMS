<?php
include 'database.php'; // Include database connection

// Fetch unresolved cases
$query = "SELECT * FROM cases WHERE status = 'Unresolved'";
$result = $conn->query($query);

// Handle escalation request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['escalate_case'])) {
    $case_id = $_POST['case_id'];
    $reason = $_POST['reason'];

    // Update case to request escalation
    $update_query = "UPDATE cases SET escalation_requested = 1, escalation_reason = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $reason, $case_id);
    $stmt->execute();

    echo "<script>alert('Escalation request submitted successfully!'); window.location.href='C_Track_Unresolved.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Unresolved Cases</title>
</head>
<body>
    <h2>Unresolved Cases</h2>
    <table border="1">
        <tr>
            <th>Case ID</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['status']; ?></td>
                <td>
                    <?php if ($row['escalation_requested'] == 0) { ?>
                        <form method="post">
                            <input type="hidden" name="case_id" value="<?= $row['id']; ?>">
                            <input type="text" name="reason" placeholder="Reason for escalation" required>
                            <button type="submit" name="escalate_case">Request Escalation</button>
                        </form>
                    <?php } else { ?>
                        <span>Escalation Requested</span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
