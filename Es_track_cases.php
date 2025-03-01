<?php
require 'database.php';

$query = "SELECT * FROM cases";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Track Cases</title>
</head>
<body>
    <h2>Track Your Cases</h2>
    <table border="1">
        <tr>
            <th>Case ID</th>
            <th>Description</th>
            <th>Status</th>
            <th>Escalation Requested</th>
            <th>Reason</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['escalation_requested'] ? 'Yes' : 'No'; ?></td>
            <td><?php echo $row['escalation_reason'] ?? 'N/A'; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
