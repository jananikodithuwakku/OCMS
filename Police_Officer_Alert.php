<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Crime Alert</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Registered Citizens</h2>
    <?php
    // Include database connection
    require 'database.php';

    // Fetch data from the citizens table
    $sql = "SELECT id, email, latitude, longitude FROM citizens";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Start the table
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                </tr>";

        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['latitude']}</td>
                    <td>{$row['longitude']}</td>
                  </tr>";
        }

        // End the table
        echo "</table>";
    } else {
        echo "<p>No registered citizens found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <h1>Officer Crime Alert</h1>
    <form action="Police_Officer_send_alert.php" method="POST">
        <label for="latitude">Crime Latitude:</label>
        <input type="text" id="latitude" name="latitude" required>
        <br>
        <label for="longitude">Crime Longitude:</label>
        <input type="text" id="longitude" name="longitude" required>
        <br>
        <input type="hidden" name="crime_alert" value="true">
        <button type="submit">Trigger Crime Alert</button>
    </form>

    
</body>
</html>