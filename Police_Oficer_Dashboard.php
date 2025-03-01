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
    <link rel="stylesheet" href="CSS/RC_Dashboard.css">
</head>
<body>

<header>
    <h2>Police Dashboard</h2>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="Logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <h3>Crime Reports</h3>
    <input type="text" id="search" placeholder="Search reports..." onkeyup="searchTable()">

    <table>
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
                        <a href="<?= $row["evidence"] ?>" target="_blank">View</a>
                    <?php else: ?>
                        No Evidence
                    <?php endif; ?>
                </td>
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

</body>
</html>
