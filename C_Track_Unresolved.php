<?php
include 'database.php'; // Include database connection

// Fetch all cases
$query = "SELECT * FROM cases";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Cases</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #121f3d; /* Dark blue background */
            font-family: 'Poppins', sans-serif;
            color: white;
        }/* Header Styling */
        header {
            background-color: #1c2c4c;
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 50px;
            margin-right: 10px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: #ffcc00;
        }
        .container {
            margin-top: 50px;
        }
        .table-container {
            background: #1c2b4d; /* Darker blue */
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        }
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }
        .table thead {
            background-color: #0b172a; /* Dark navy */
            color: #f8f9fa;
        }
        .table th, .table td {
            padding: 16px;
            text-align: left;
            color: white;
        }
        .table tbody tr {
            background: #243b65; /* Slightly lighter blue */
            border-radius: 10px;
            transition: all 0.3s;
        }
        .table tbody tr:hover {
            background: #2f4a7d;
            transform: scale(1.02);
        }
        .badge-status {
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 8px;
            font-weight: 600;
        }
        .badge-unresolved {
            background-color: #f39c12;
            color: white;
        }
        .badge-resolved {
            background-color: #28a745;
            color: white;
        }
        h2 {
            font-weight: 600;
            text-align: center;
        }
        /* Footer */
        .footer {
            background-color: #002147;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<header class="navbar">
        <div class="logo">
            <img src="Images/Logo.png" alt="OCMS Logo">
            <span>Online Crime Management System</span>
        </div>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Contact.php" class="active">Contact</a></li>
                <li><a href="Features.php">Features</a></li>
                <li><a href="Login.php">Login</a></li>
            </ul>
        </nav>
    </header>

<div class="container">
    <h2 class="mb-4"> Track Unresolved Cases</h2>
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Case ID</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td>
                            <span class="badge-status 
                                <?= ($row['status'] == 'Unresolved') ? 'badge-unresolved' : 'badge-resolved'; ?>">
                                <?= $row['status']; ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Footer -->
<footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
