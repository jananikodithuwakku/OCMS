<?php
include 'database.php';

// Validate and retrieve the complaint ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $complaint_id = intval($_GET['id']); // Convert to integer for security
} else {
    die("Invalid Complaint ID.");
}

// Fetch the specific crime report
$sql = "SELECT * FROM crime_reports WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $complaint_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the complaint exists
if (!$result || mysqli_num_rows($result) == 0) {
    die("Complaint not found.");
}
$complaint = mysqli_fetch_assoc($result);

// Fetch all updates for this complaint
$updates_sql = "SELECT * FROM updates WHERE report_id = ? ORDER BY update_date DESC";
$updates_stmt = mysqli_prepare($conn, $updates_sql);
mysqli_stmt_bind_param($updates_stmt, "i", $complaint_id);
mysqli_stmt_execute($updates_stmt);
$updates_result = mysqli_stmt_get_result($updates_stmt);

// Handle CSV download
if (isset($_POST['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="complaint_report_' . $complaint_id . '.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Location', 'Date', 'Description', 'Status']);
    fputcsv($output, [
        $complaint['id'],
        $complaint['name'],
        $complaint['email'],
        $complaint['phone'],
        $complaint['location'],
        $complaint['date'],
        $complaint['description'],
        $complaint['status']
    ]);

    fputcsv($output, []); // Blank line
    fputcsv($output, ['Updates']);
    fputcsv($output, ['Update Text', 'Update Date']);

    while ($update = mysqli_fetch_assoc($updates_result)) {
        fputcsv($output, [$update['update_text'], $update['update_date']]);
    }

    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .download-btn { padding: 10px 15px; background: green; color: white; border: none; cursor: pointer; }
        .back-btn { display: inline-block; margin-top: 10px; padding: 10px 15px; background: #007bff; color: white; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Complaint Details</h2>
    <table>
        <tr><th>ID</th><td><?= htmlspecialchars($complaint['id']) ?></td></tr>
        <tr><th>Name</th><td><?= htmlspecialchars($complaint['name']) ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($complaint['email']) ?></td></tr>
        <tr><th>Phone</th><td><?= htmlspecialchars($complaint['phone']) ?></td></tr>
        <tr><th>Location</th><td><?= htmlspecialchars($complaint['location']) ?></td></tr>
        <tr><th>Date</th><td><?= htmlspecialchars($complaint['date']) ?></td></tr>
        <tr><th>Description</th><td><?= nl2br(htmlspecialchars($complaint['description'])) ?></td></tr>
        <tr><th>Status</th><td><?= htmlspecialchars($complaint['status']) ?></td></tr>
    </table>

    <h3>Updates</h3>
    <?php if (mysqli_num_rows($updates_result) > 0): ?>
        <table>
            <tr><th>Update Text</th><th>Update Date</th></tr>
            <?php while ($update = mysqli_fetch_assoc($updates_result)): ?>
                <tr>
                    <td><?= htmlspecialchars($update['update_text']) ?></td>
                    <td><?= htmlspecialchars($update['update_date']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No updates available.</p>
    <?php endif; ?>

    <form method="POST">
        <button type="submit" name="download" class="download-btn">Download Report as CSV</button>
    </form>

    <a href="Police_Officer_View-Complaints.php" class="back-btn">Back to Complaints</a>
</body>
</html>
