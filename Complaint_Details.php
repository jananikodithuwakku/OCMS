<?php
include 'database.php';

// Validate and retrieve the complaint ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $complaint_id = intval($_GET['id']); // Convert to integer for security
} else {
    die("Invalid Complaint ID.");
}

// Fetch the specific crime report
$sql = "SELECT * FROM crime_reports WHERE id = $complaint_id";
$result = mysqli_query($conn, $sql);

// Check if the complaint exists
if (!$result || mysqli_num_rows($result) == 0) {
    die("Complaint not found.");
}

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
    <p><strong>ID:</strong> <?= htmlspecialchars($complaint['id']) ?></p>
    <p><strong>Name:</strong> <?= htmlspecialchars($complaint['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($complaint['email']) ?></p>
    <p><strong>Phone:</strong> <?= htmlspecialchars($complaint['phone']) ?></p>
    <p><strong>Location:</strong> <?= htmlspecialchars($complaint['location']) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($complaint['date']) ?></p>
    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($complaint['description'])) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($complaint['status']) ?></p>

    <h3>Updates</h3>
    <?php if (mysqli_num_rows($updates_result) > 0): ?>
        <ul>
            <?php while ($update = mysqli_fetch_assoc($updates_result)): ?>
                <li><?= htmlspecialchars($update['update_text']) ?> - <?= htmlspecialchars($update['update_date']) ?></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No updates available.</p>
    <?php endif; ?>

    <a href="View_Complaints.php">Back to Complaints</a>
</body>
</html>
