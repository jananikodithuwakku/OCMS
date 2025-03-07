<?php
include 'database.php';

// Fetch all crime reports from the database
$sql = "SELECT * FROM crime_reports ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Complaint Reports</title>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: #1e3c72; /* Dark blue gradient background */
            margin: 0;
            padding: 0;
            color: white;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
            color: white;
            padding: 15px;
            text-align: center;
            backdrop-filter: blur(5px); /* Frosted glass effect */
        }

        nav {
            text-align: center;
            margin-top: 10px;
        }

        nav a {
            text-decoration: none;
            color: white;
            background: rgba(255, 255, 255, 0.2); /* Transparent buttons */
            padding: 10px 15px;
            border-radius: 5px;
            margin: 0 10px;
            transition: 0.3s;
        }

        nav a:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Main Content */
        main {
            width: 90%;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px); /* Glass effect */
        }

        h1, h2 {
            text-align: center;
            color: white;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent background */
            color: white;
        }

        table, th, td {
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: rgba(255, 255, 255, 0.2); /* Slightly transparent */
        }

        tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Crime Complaint Reports</h1>
        <nav>
            <a href="Home.php">Home</a>
            <a href="Admin_Logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <h2>All Crime Reports</h2>
        <table>
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
                <td><?= htmlspecialchars($row['id']); ?></td>
                <td><?= htmlspecialchars($row['date']); ?></td>
                <td><?= htmlspecialchars($row['location']); ?></td>
                <td><?= nl2br(htmlspecialchars($row['description'])); ?></td>
                <td><?= htmlspecialchars($row['status']); ?></td>
                <td>
                    <?php 
                    if (!empty($row['assigned_officer'])) {
                        $officer_id = $row['assigned_officer'];
                        $officer_query = "SELECT name FROM police_officers WHERE id='$officer_id'";
                        $officer_result = mysqli_query($conn, $officer_query);
                        $officer = mysqli_fetch_assoc($officer_result);
                        echo $officer ? htmlspecialchars($officer['name']) : 'Not Assigned';
                    } else {
                        echo 'Not Assigned';
                    }
                    ?>
                </td>
                <td><?= nl2br(htmlspecialchars($row['investigation_updates'] ?? 'No updates yet.')); ?></td>
            </tr>
            <?php } ?>
        </table>
    </main>

</body>
</html>

<?php
mysqli_close($conn);
?>
