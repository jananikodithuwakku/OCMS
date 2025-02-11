<?php
include 'database.php';

// Fetch all complaints
$complaints_query = "SELECT * FROM crime_reports";
$complaints_result = mysqli_query($conn, $complaints_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Dashboard</title>
    <link rel="stylesheet" href="CSS/Citizen_Dashboard.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Images/Logo.png" alt="Online Crime Management System">
            <h1>Citizen Dashboard</h1>
        </div>
    </header>

    <main>
        <h2>All Complaints</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th>Investigation Notes</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($complaints_result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo !empty($row['notes']) ? $row['notes'] : "No notes yet"; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>

    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
