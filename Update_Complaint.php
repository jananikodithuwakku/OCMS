<?php 
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    // Check if the 'notes' column exists in the table
    $column_check_query = "SHOW COLUMNS FROM crime_reports LIKE 'notes'";
    $column_check_result = mysqli_query($conn, $column_check_query);
    if (mysqli_num_rows($column_check_result) == 0) {
        echo "<script>alert('Error: Column \"notes\" does not exist in crime_reports table.');</script>";
        exit();
    }

    // Update the crime_reports table
    $sql = "UPDATE crime_reports SET status='$status', notes='$notes' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Complaint updated successfully!'); window.location.href='police_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch the complaint if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM crime_reports WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $report = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Complaint not found!'); window.location.href='police_dashboard.php';</script>";
        exit();
    }
} else {
    header("Location: police_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Complaint</title>
    <link rel="stylesheet" href="CSS/Update_Complaint.css">
</head>
<body>
    <header>
        <h1>Update Complaint</h1>
        <nav>
            <ul>
                <li><a href="police_dashboard.php">Back to Dashboard</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>Complaint Details</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $report['id']; ?>">
            
            <label for="status">Status:</label>
            <select name="status" required>
                <option value="Pending" <?php if (!empty($report['status']) && $report['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="In Progress" <?php if (!empty($report['status']) && $report['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Resolved" <?php if (!empty($report['status']) && $report['status'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
            </select>
            
            <label for="notes">Investigation Notes:</label>
            <textarea name="notes" rows="4" required><?php echo htmlspecialchars($report['notes'] ?? ''); ?></textarea>
            
            <button type="submit" name="update">Update Complaint</button>
        </form>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>
