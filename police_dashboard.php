<?php

include 'database.php';

// Fetch all crime reports
$sql = "SELECT * FROM crime_reports ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Dashboard</title>
    <link rel="stylesheet" href="CSS/Police_Dashboard.css">
</head>
<body>
    <header>
        <h1>Police Officer Dashboard</h1>
        <nav>
            <ul>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>Crime Reports</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['status'] ?? 'Pending'); ?></td>
                    <td><a href="update_complaint.php?id=<?php echo $row['id']; ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>
