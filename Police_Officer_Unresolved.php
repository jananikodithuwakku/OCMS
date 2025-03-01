<?php
include 'database.php';

session_start();

// Fetch escalated cases
$query = "SELECT * FROM cases WHERE escalation_requested = 1";
$result = $conn->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $case_id = $_POST['case_id'];
    $new_status = $_POST['status'];

    // Update case status
    $update_query = "UPDATE cases SET status = ?, escalation_requested = 0 WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_status, $case_id);
    $stmt->execute();

    echo "<script>alert('Case status updated successfully!'); window.location.href='Police_Officer_Unresolved.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Police Dashboard</title>
</head>
<body>
    <h2>Escalated Cases</h2>
    <table border="1">
        <tr>
            <th>Case ID</th>
            <th>Description</th>
            <th>Escalation Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['escalation_reason']; ?></td>
                <td><?= $row['status']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="case_id" value="<?= $row['id']; ?>">
                        <select name="status">
                            <option value="Under Investigation">Under Investigation</option>
                            <option value="Resolved">Resolved</option>
                        </select>
                        <button type="submit" name="update_status">Update Status</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
