<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Crime Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c3e50;
            color: #ecf0f1;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: rgb(2, 7, 59);
            color: white;
            padding: 20px 0;
        }

        header h2 {
            margin: 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            color: #ecf0f1;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            color: #ecf0f1;
            margin-top: 40px;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #34495e;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: #ecf0f1;
        }

        tr:nth-child(even) {
            background-color: #34495e;
        }

        tr:hover {
            background-color: #16a085;
        }

        form {
            background-color: #34495e;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            width: 60%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            color: #ecf0f1;
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            background-color: #2c3e50;
            color: #ecf0f1;
            border: 1px solid #34495e;
            border-radius: 4px;
        }

        button {
            background-color: #16a085;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #1abc9c;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div class="container">
            <h2>Registered Citizens</h2>
            <nav>
                <ul>
                    <li><a href="Police_Officer_Dashboard.php">Dashboard</a></li>
                    <li><a href="Admin_Logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

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
        echo "<p style='text-align: center;'>No registered citizens found.</p>";
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
</div>

</body>
</html>
