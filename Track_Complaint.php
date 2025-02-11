<?php

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sql = "SELECT * FROM crime_reports WHERE email='$email' ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);
} else {
    $result = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Complaint</title>
    <link rel="stylesheet" href="CSS/Track_Complaint.css">
</head>
<body>
    <header>
        <h1>Track Your Complaint</h1>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>Enter your email to track complaints</h2>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Track Complaint</button>
        </form>
        
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <h3>Your Complaints</h3>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Notes</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['status'] ?? 'Pending'); ?></td>
                        <td><?php echo htmlspecialchars($row['notes'] ?? 'No updates yet'); ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } elseif ($result) { ?>
            <p>No complaints found for this email.</p>
        <?php } ?>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>
