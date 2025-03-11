<?php
include 'database.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']); // Get the complaint ID
$sql = "SELECT * FROM crime_reports WHERE id = $id";
$result = mysqli_query($conn, $sql);
$complaint = mysqli_fetch_assoc($result);

if (!$complaint) {
    die("Complaint not found.");
}

// Create the report content
$reportContent = "
<html>
<head>
    <title>Complaint Report</title>
</head>
<body>
    <h2>Complaint Report</h2>
    <p><strong>Complaint ID:</strong> {$complaint['id']}</p>
    <p><strong>Location:</strong> {$complaint['location']}</p>
    <p><strong>Date:</strong> {$complaint['date']}</p>
    <p><strong>Status:</strong> {$complaint['status']}</p>
    <p><strong>Notes:</strong> {$complaint['notes']}</p>
    <p><strong>Generated on:</strong> " . date('Y-m-d H:i:s') . "</p>
</body>
</html>";

// Set headers to force download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="Complaint_Report_'.$id.'.html"');
header('Content-Length: ' . strlen($reportContent));

echo $reportContent;
exit;
?>
