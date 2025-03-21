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

// Report content with logo and better styling
$reportContent = "
<html>
<head>
    <title>Complaint Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color:rgb(128, 146, 163); }
        .report-container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { max-width: 120px; }
        .header h2 { margin: 10px 0; color: #333; }
        .report-content p { font-size: 16px; line-height: 1.5; margin: 10px 0; }
        .report-content strong { color: #007bff; }
        .footer { margin-top: 20px; text-align: center; font-size: 14px; color: gray; }
    </style>
</head>
<body>
    <div class='report-container'>
        <div class='header'>
            <img src='" . realpath('Images/Logo.png') . "' alt='Logo'>
            <h2>Complaint Report</h2>
        </div>
        <div class='report-content'>
            <p><strong>Complaint ID:</strong> {$complaint['id']}</p>
            <p><strong>Location:</strong> {$complaint['location']}</p>
            <p><strong>Date:</strong> {$complaint['date']}</p>
            <p><strong>Status:</strong> {$complaint['status']}</p>
            <p><strong>Notes:</strong> {$complaint['notes']}</p>
        </div>
        <div class='footer'>
            <p>Generated on: " . date('Y-m-d H:i:s') . "</p>
        </div>
    </div>
</body>
</html>";

// Set headers to force download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="Complaint_Report_'.$id.'.html"');
header('Content-Length: ' . strlen($reportContent));

echo $reportContent;
exit;
?>
