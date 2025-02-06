<?php
include 'database.php';

// Fetch all crime reports
$sql = "SELECT * FROM crime_reports";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Complaints</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Date</th>
            <th>Description</th>
            <th>Evidence</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['description'] ?></td>
            <td>
                <?php if (!empty($row['evidence'])): ?>
                    <a href="<?= $row['evidence'] ?>" target="_blank">View Evidence</a>
                <?php else: ?>
                    No evidence
                <?php endif; ?>
            </td>
            <td>
                <!-- Link to Update_Complaint.php with the correct ID -->
                <a href="Update_Complaint.php?id=<?= $row['id'] ?>">Update Complaint</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>