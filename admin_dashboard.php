<?php
include 'database.php';

$user_email = $_SESSION["user"]; // Fetch user email from session
$sql = "SELECT * FROM crime_reports WHERE email='$user_email' ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Complaint</title>
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
        <h2>Your Crime Reports</h2>
        <table border="1">
            <tr>
                <th>Case ID</th>
                <th>Date</th>
                <th>Location</th>
                <th>Description</th>
                <th>Status</th>
                <th>Assigned Officer</th>
                <th>Investigation Updates</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <?php 
                    $officer_id = $row['assigned_officer'];
                    $officer_query = "SELECT name FROM police_officers WHERE id='$officer_id'";
                    $officer_result = mysqli_query($conn, $officer_query);
                    $officer = mysqli_fetch_assoc($officer_result);
                    echo $officer ? $officer['name'] : 'Not Assigned';
                    ?>
                </td>
                <td><?php echo $row['investigation_updates']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>
