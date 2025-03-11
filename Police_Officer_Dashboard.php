<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'police_officer') {
    header("Location: Admin_Panel.php");
    exit();
}

include 'database.php';

// Fetch case statistics for the chart (case status counts)
$status_counts = ["Pending" => 0, "In Progress" => 0, "Resolved" => 0];
$sql_status = "SELECT status, COUNT(*) as count FROM crime_reports GROUP BY status";
$status_result = mysqli_query($conn, $sql_status);
while ($row = mysqli_fetch_assoc($status_result)) {
    if (isset($status_counts[$row['status']])) {
        $status_counts[$row['status']] = $row['count'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Analytics</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #0A1931;
            padding-top: 20px;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            width: 120px;
        }
        .sidebar a {
            display: block;
            color: #ffffff;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            background-color: #1B2C53;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .chart-container {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .table-responsive {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
    <div class="logo">
            <img src="Images/Logo.png" alt="Logo">
        </div>
        <a href="police_officer_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="Police_Officer_Unresolved.php"><i class="fas fa-briefcase"></i> View Escalated Cases</a>
        <a href="Police_Oficer_View_Complaints.php"><i class="fas fa-chart-bar"></i> Crime Analytics</a>
        <a href="Police_Officer_Update_Complaints.php"><i class="fas fa-edit"></i> Update Complaint</a>
        <a href="Police_Officer_Alert.php"><i class="fa fa-warning"></i> Geolocation Alerts</a>
        <a href="Admin_Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content"> 
        <h2>Crime Analytics</h2>
        <p>View crime case status analytics in the chart below:</p>

        <!-- Crime Status Chart -->
        <div class="chart-container">
            <h4>Crime Case Status Distribution</h4>
            <canvas id="crimeStatusChart" width="400" height="400"></canvas>
        </div>

    </div>

    <!-- Chart.js Script -->
    <script>
        var ctx = document.getElementById('crimeStatusChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Pending", "In Progress", "Resolved"],
                datasets: [{
                    label: "Case Status",
                    data: <?= json_encode(array_values($status_counts)) ?>,
                    backgroundColor: ['#FF5733', '#FFD700', '#28A745']
                }]
            }
        });
    </script>

</body>
</html>
