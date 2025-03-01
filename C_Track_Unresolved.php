<?php
include 'database.php'; // Include database connection

// Fetch all cases
$query = "SELECT * FROM cases";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Track Cases</title>
</head>
<body>
    <h2>Track Cases</h2>
    <table border="1">
        <tr>
            <th>Case ID</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['status']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
