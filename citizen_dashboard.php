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
mysqli_stmt_bind_param($stmt, "s", $user_email);
mysqli_stmt_execute($stmt);
$complaints_result = mysqli_stmt_get_result($stmt);

// Fetch verification status
$query = "SELECT is_verified FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $user_email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$is_verified = $row['is_verified'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Dashboard</title>
    
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="CSS/Citizen_Dashboard.css">

    <style>
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #051f3a;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            display: block;
            color: white;
            font-size: 16px;
        }
        .sidebar a:hover {
            background: #007bff;
            text-decoration: none;
        }
        .logo {
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 120px;
        }

        /* Main Content Styles */
        .content {
            margin-left: 270px; /* Ensure content does not overlap sidebar */
            padding: 20px;
        }

        /* Adjust header */
        .custom-header {
            background-color: #051f3a;
            color: white;
            padding: 15px;
        }

        /* Badge Styling */
        .bg-warning {
            background-color: #ffc107 !important;
            color: black;
        }
        .bg-success {
            background-color: #28a745 !important;
            color: white;
        }

        /* Table Styling */
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="Images/Logo.png" alt="Logo">
        </div>
        <a href="citizen_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <header class="custom-header">
            <div class="container">
                <h1 class="text-white">Citizen Dashboard</h1>
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
                                    <span class="badge <?php echo ($row['status'] == 'Resolved') ? 'bg-success' : 'bg-warning'; ?>">
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

            <!-- Email Verification Section -->
            <div class="mt-5">
                <h3>Email Verification</h3>
                
                <?php if ($is_verified): ?>
                    <p class="text-success"><i class="fas fa-check-circle"></i> Your email is verified.</p>
                <?php else: ?>
                    <p class="text-warning"><i class="fas fa-exclamation-circle"></i> Your email is not verified.</p>
                    <a href="Citizen_send_verification.php" class="btn btn-primary">Verify Now</a>
                <?php endif; ?>
            </div>
        </main>

        <footer class="footer text-center p-3 mt-5">
            <p class="mb-0">&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
