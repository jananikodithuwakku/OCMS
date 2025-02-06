<?php
include 'database.php';

$sql = "SELECT * FROM crime_reports";
$result = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="crime_reports.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID', 'Name', 'Email', 'Phone', 'Location', 'Date', 'Description', 'Evidence'));

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
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
    <title>Generate Reports</title>
</head>
<body>
    <h2>Generate Reports</h2>
    <form method="POST">
        <button type="submit">Download CSV Report</button>
    </form>
</body>
</html>