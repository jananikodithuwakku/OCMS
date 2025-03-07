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
        echo "<script>alert('Complaint updated successfully!'); window.location.href='Police_Oficer_View_Complaints.php';</script>";
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
        echo "<script>alert('Complaint not found!'); window.location.href='Police_Oficer_View_Complaints.php';</script>";
        exit();
    }
} else {
    header("Location: Police_Oficer_View_Complaints.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Complaint</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        header {
            background-color: rgb(4, 22, 80);
            color: white;
            padding: 20px;
            text-align: center;
        }
        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            background-color:rgb(4, 22, 80);
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(4, 22, 80);
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Update Complaint</h1>
    <nav>
        <ul class="nav justify-content-center">
            <li class="nav-item"><a href="Police_Officer_Dashboard.php" class="nav-link text-white">Back to Dashboard</a></li>
            <li class="nav-item"><a href="Admin_Logout.php" class="nav-link text-white">Logout</a></li>
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

<footer>
    <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
</footer>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php
mysqli_close($conn);
?>
