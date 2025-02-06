<?php
include 'database.php';

// Check if 'id' is set in the URL
if (!isset($_GET['id'])) {
    die("Error: Complaint ID is missing.");
}

$complaint_id = intval($_GET['id']); // Ensure the ID is an integer

// Fetch the specific crime report
$sql = "SELECT * FROM crime_reports WHERE id = $complaint_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn)); // Handle SQL errors
}

if (mysqli_num_rows($result) == 0) {
    die("Error: No complaint found with the provided ID.");
}

$complaint = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_text = mysqli_real_escape_string($conn, $_POST['update_text']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Insert the update into the updates table
    $update_sql = "INSERT INTO updates (report_id, update_text) VALUES ($complaint_id, '$update_text')";
    if (!mysqli_query($conn, $update_sql)) {
        die("Error: " . mysqli_error($conn));
    }

    // Update the status of the complaint
    $status_sql = "UPDATE crime_reports SET status = '$status' WHERE id = $complaint_id";
    if (!mysqli_query($conn, $status_sql)) {
        die("Error: " . mysqli_error($conn));
    }

    echo "<script>alert('Complaint updated successfully!');</script>";
}

// Fetch all updates for this complaint
$updates_sql = "SELECT * FROM updates WHERE report_id = $complaint_id ORDER BY update_date DESC";
$updates_result = mysqli_query($conn, $updates_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Complaint</title>
</head>
<body>
    <h2>Update Complaint</h2>
    <p><strong>Complaint ID:</strong> <?= $complaint['id'] ?></p>
    <p><strong>Current Status:</strong> <?= $complaint['status'] ?></p>

    <h3>Add Update</h3>
    <form method="POST">
        <textarea name="update_text" placeholder="Enter update details" required></textarea><br><br>
        <select name="status">
            <option value="pending">Pending</option>
            <option value="under_investigation">Under Investigation</option>
            <option value="resolved">Resolved</option>
        </select><br><br>
        <button type="submit">Submit Update</button>
    </form>

    <h3>Previous Updates</h3>
    <?php while ($update = mysqli_fetch_assoc($updates_result)): ?>
    <p><?= $update['update_text'] ?> - <?= $update['update_date'] ?></p>
    <?php endwhile; ?>

    <a href="View_Complaints.php">Back to Complaints</a>
</body>
</html>