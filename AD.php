<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: Admin_Panel.php");
    exit();
}

include 'database.php';

// Fetch crime data for charts

$crime_counts = [];
$monthly_crimes = [];
$status_labels = ["Pending", "In Progress", "Resolved"];
$status_counts = [0, 0, 0];



// Get monthly crime trends
$sql = "SELECT MONTH(date) AS month, COUNT(*) AS count FROM crime_reports GROUP BY MONTH(date)";
$result = mysqli_query($conn, $sql);
$monthly_data = array_fill(1, 12, 0);
while ($row = mysqli_fetch_assoc($result)) {
    $monthly_data[$row['month']] = $row['count'];
}
$monthly_crimes = array_values($monthly_data);

// Get crime resolution status counts
$sql = "SELECT status, COUNT(*) AS count FROM crime_reports GROUP BY status";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['status'] == "Pending") $status_counts[0] = $row['count'];
    elseif ($row['status'] == "In Progress") $status_counts[1] = $row['count'];
    elseif ($row['status'] == "Resolved") $status_counts[2] = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            width: 60%;  /* You can adjust the width as needed */
            text-align: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="Images/Logo.png" alt="Logo">
        </div>
        <a href="AD.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="Analytics_Report.php"><i class="fas fa-chart-line"></i> Resolved Cases</a>
        <a href="Admin_Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Admin Dashboard</h2>
        <p>View crime statistics and manage reports.</p>


        <!-- Monthly Crimes Chart -->
        <div class="chart-container">
            <h4>Monthly Crime Reports</h4>
            <canvas id="monthlyCrimeChart"></canvas>
        </div>

        <!-- Crime Status Pie Chart -->
<div class="chart-container">
    <h4>Crime Resolution Status</h4>
    <canvas id="crimeStatusChart" style="width: 500px; height: 500px;"></canvas>
</div>

    </div>

    <!-- Chart.js Script -->
    <script>
        
        // Monthly Crime Line Chart
        var ctx2 = document.getElementById('monthlyCrimeChart').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Crimes Reported',
                    data: <?php echo json_encode($monthly_crimes); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    borderWidth: 2
                }]
            }
        });

        // Crime Status Pie Chart
var ctx3 = document.getElementById('crimeStatusChart').getContext('2d');
new Chart(ctx3, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($status_labels); ?>,
        datasets: [{
            label: 'Status Count',
            data: <?php echo json_encode($status_counts); ?>,
            backgroundColor: ['#FFCE56', '#36A2EB', '#4CAF50'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false,  // Disable automatic resizing by Chart.js
        maintainAspectRatio: false  // Disable maintaining the aspect ratio
    }
});

    </script>

</body>
</html>
