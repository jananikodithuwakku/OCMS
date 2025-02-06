<?php
include 'database.php';

// Fetch all complaints (no user-specific filtering)
$sql = "SELECT * FROM crime_reports";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Complaints</title>
</head>
<body>
    <h2>All Complaints</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><a href="Complaint_Details.php?id=<?= $row['id'] ?>">View Details</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>