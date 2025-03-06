<?php
session_start();
include 'database.php';

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    header("Location: Citi_Dash_Login.php");
    exit();
}

$user_email = $_SESSION["email"];

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch complaints only for the logged-in user
$complaints_query = "SELECT * FROM crime_reports WHERE email = ?";
$stmt = mysqli_prepare($conn, $complaints_query);

if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $user_email);
mysqli_stmt_execute($stmt);
$complaints_result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Citizen_Dashboard.css">
    <style>
        /* Apply the dark blue color to the header and footer */
        .custom-header, .custom-footer {
            background-color: #051f3a !important;
            color: white;
        }
        /* Adjust body background to complement the theme */
        body {
            background-color: #f4f4f4;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .badge-warning {
            background-color: #ffc107;
            color: black;
        }
        .badge-success {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <header class="navbar navbar-expand-lg custom-header shadow p-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center text-white" href="#">
                <img src="Images/Logo.png" alt="Online Crime Management System" width="50">
                <h1 class="ms-3 fs-4 mb-0">Citizen Dashboard</h1>
            </a>
        </div>
    </header>

    <main class="container mt-4">
        <h2 class="text-center text-uppercase text-dark">My Complaints</h2>
        
        <?php if ($complaints_result && mysqli_num_rows($complaints_result) > 0): ?>
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>ID</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Investigation Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($complaints_result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <span class="badge <?php echo ($row['status'] == 'Resolved') ? 'badge-success' : 'badge-warning'; ?>">
                                    <?php echo htmlspecialchars($row['status']); ?>
                                </span>
                            </td>
                            <td><?php echo !empty($row['notes']) ? htmlspecialchars($row['notes']) : "<i>No notes yet</i>"; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center mt-4">No complaints found.</p>
        <?php endif; ?>
    </main>

    <footer class="footer custom-footer text-center p-3 mt-5">
        <p class="mb-0">&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
