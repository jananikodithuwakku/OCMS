<?php
require 'database.php';

$query = "SELECT * FROM cases WHERE escalation_requested = 1";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Police Dashboard</title>
</head>
<body>
    <h2>Escalated Cases</h2>
    <table border="1">
        <tr>
            <th>Case ID</th>
            <th>Description</th>
            <th>Reason</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['escalation_reason']; ?></td>
            <td>
                <a href="resolve_escalation.php?case_id=<?php echo $row['id']; ?>">Resolve</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
