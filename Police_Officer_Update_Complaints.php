<?php
include 'database.php';

// Fetch all crime reports
$sql = "SELECT * FROM crime_reports";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(243, 237, 237);
        }
        header {
            background-color:rgb(4, 22, 122);
            color: white;
            padding: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        table th {
            background-color:rgb(7, 18, 82);
            color: black;
            padding: 12px;
            

        }
        table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn-link {
            color:rgb(2, 51, 104);
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h2>Complaints Dashboard</h2>
    <ul class="nav justify-content-center">
            <li class="nav-item"><a href="Police_Officer_Dashboard.php" class="nav-link text-white">Back to Dashboard</a></li>
            <li class="nav-item"><a href="Admin_Logout.php" class="nav-link text-white">Logout</a></li>
    </ul>
</header>

<main class="container my-4">
    <h3 class="mb-4">All Complaints</h3>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Date</th>
                <th>Description</th>
                <th>Evidence</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['location'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= substr($row['description'], 0, 50) . '...' ?></td>
                    <td>
                        <?php if (!empty($row['evidence'])): ?>
                            <a href="<?= $row['evidence'] ?>" target="_blank" class="btn btn-link">View Evidence</a>
                        <?php else: ?>
                            No evidence
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="Update_Complaint.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Update Complaint</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<footer>
    <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
</footer>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
