<?php
include 'database.php';

$complaint_id = $_GET['id']; // Get the complaint ID from the URL

// Fetch the specific crime report
$sql = "SELECT * FROM crime_reports WHERE id = $complaint_id";
$result = mysqli_query($conn, $sql);
$complaint = mysqli_fetch_assoc($result);

// Fetch all updates for this complaint
$updates_sql = "SELECT * FROM updates WHERE report_id = $complaint_id ORDER BY update_date DESC";
$updates_result = mysqli_query($conn, $updates_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
</head>
<body>
    <h2>Complaint Details</h2>
    <p><strong>ID:</strong> <?= $complaint['id'] ?></p>
    <p><strong>Name:</strong> <?= $complaint['name'] ?></p>
    <p><strong>Email:</strong> <?= $complaint['email'] ?></p>
    <p><strong>Phone:</strong> <?= $complaint['phone'] ?></p>
    <p><strong>Location:</strong> <?= $complaint['location'] ?></p>
    <p><strong>Date:</strong> <?= $complaint['date'] ?></p>
    <p><strong>Description:</strong> <?= $complaint['description'] ?></p>
    <p><strong>Status:</strong> <?= $complaint['status'] ?></p>

    <h3>Updates</h3>
    <?php while ($update = mysqli_fetch_assoc($updates_result)): ?>
    <p><?= $update['update_text'] ?> - <?= $update['update_date'] ?></p>
    <?php endwhile; ?>

    <a href="View_Complaints.php">Back to Complaints</a>
</body>
</html>