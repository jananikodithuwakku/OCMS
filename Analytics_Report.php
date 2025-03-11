<?php
include 'database.php';

// Fetch only resolved complaints for the admin
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
    <title>Resolved Complaints - Admin Report</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .download-btn {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            transition: 0.3s;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="AD.php">
                <i class="fa-solid fa-shield-halved"></i> Admin Dashboard
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="table-container">
            <h2 class="mb-3 text-center text-primary">
                <i class="fa-solid fa-file-chart-column"></i> Resolved Complaints Report
            </h2>

            <table id="complaintsTable" class="table table-striped table-bordered">
                <thead class="table-dark">
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
                    <?php
                    mysqli_data_seek($result, 0); // Reset result set pointer
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><span class="badge bg-success"><?php echo htmlspecialchars($row['status']); ?></span></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Download CSV Button -->
            <form action="" method="POST" class="text-center mt-3">
                <button type="submit" name="download" class="btn download-btn">
                    <i class="fa-solid fa-file-csv"></i> Download Report as CSV
                </button>
            </form>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>

    <!-- jQuery and Bootstrap Bundle (Popper included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#complaintsTable').DataTable();
        });
    </script>

</body>
</html>
