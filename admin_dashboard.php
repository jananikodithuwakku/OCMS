<?php
include 'database.php';

// Fetch all crime reports from the database
$sql = "SELECT * FROM crime_reports ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Reports</title>
    <link rel="stylesheet" href="CSS/Track_Complaint.css">
</head>
<body>
    <header>
        <h1>Crime Complaint Reports</h1>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>All Crime Reports</h2>
        <table border="1">
            <tr>
                <th>Case ID</th>
                <th>Date</th>
                <th>Location</th>
                <th>Description</th>
                <th>Status</th>
                <th>Assigned Officer</th>
                <th>Investigation Updates</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['id']); ?></td>
                <td><?= htmlspecialchars($row['date']); ?></td>
                <td><?= htmlspecialchars($row['location']); ?></td>
                <td><?= nl2br(htmlspecialchars($row['description'])); ?></td>
                <td><?= htmlspecialchars($row['status']); ?></td>
                <td>
                    <?php 
                    if (!empty($row['assigned_officer'])) {
                        $officer_id = $row['assigned_officer'];
                        $officer_query = "SELECT name FROM police_officers WHERE id='$officer_id'";
                        $officer_result = mysqli_query($conn, $officer_query);
                        $officer = mysqli_fetch_assoc($officer_result);
                        echo $officer ? htmlspecialchars($officer['name']) : 'Not Assigned';
                    } else {
                        echo 'Not Assigned';
                    }
                    ?>
                </td>
                <td><?= nl2br(htmlspecialchars($row['investigation_updates'] ?? 'No updates yet.')); ?></td>
            </tr>
            <?php } ?>
        </table>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>
