<?php
include 'database.php';

// Fetch only resolved complaints for citizens to view/download
$sql = "SELECT name, email, phone, location, date, description, status FROM crime_reports WHERE status = 'Resolved'";
$result = mysqli_query($conn, $sql);

if (isset($_POST['download'])) {
    // Generate CSV file for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="resolved_complaints.csv"');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Name', 'Email', 'Phone', 'Location', 'Date', 'Description', 'Status']);
    
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolved Complaints</title>
    <link rel="stylesheet" href="CSS/Resolved_Complaints.css">
</head>
<body>
    <header>
        <h1>Resolved Complaints</h1>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>View Resolved Complaints</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <form action="" method="POST">
            <button type="submit" name="download">Download Report as CSV</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
