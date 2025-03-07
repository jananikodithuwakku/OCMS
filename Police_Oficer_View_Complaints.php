<?php
include 'database.php';

// Fetch crime reports
$sql = "SELECT * FROM crime_reports ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/RC_Dashboard.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
        }
        header h2 {
            margin: 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        main {
            padding: 30px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table th {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
        }
        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
        input[type="text"] {
            padding: 10px;
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h2>Police Dashboard</h2>
        <nav>
            <ul>
                <li><a href="Police_Officer_Dashboard.php">Dashboard</a></li>
                <li><a href="Admin_Logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">
    <h3>Crime Reports</h3>
    <input type="text" id="search" placeholder="Search reports..." onkeyup="searchTable()" class="form-control">

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Reporter</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Date</th>
                <th>Description</th>
                <th>Evidence</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["phone"] ?></td>
                    <td><?= $row["location"] ?></td>
                    <td><?= $row["date"] ?></td>
                    <td><?= substr($row["description"], 0, 50) ?>...</td>
                    <td>
                        <?php if (!empty($row["evidence"])): ?>
                            <a href="<?= $row["evidence"] ?>" target="_blank" class="btn btn-link">View</a>
                        <?php else: ?>
                            No Evidence
                        <?php endif; ?>
                    </td>
                    <td><?= $row["status"] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<script>
function searchTable() {
    let input = document.getElementById("search").value.toLowerCase();
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
}
</script>

<footer>
    <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
</footer>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
