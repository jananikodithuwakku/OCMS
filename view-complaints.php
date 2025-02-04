<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <link rel="stylesheet" href="CSS/view-complaints.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Logo.png" alt="Logo">
        </div>
        <h1>View Complaints</h1>
        <nav>
            <ul class="navbar">
                <li><a href="Home.html">Home</a></li>
                <li><a href="view-crime-map.html">Crime Map</a></li>
                <li><a href="help-center.html">Help Center</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="complaints-container">
        <h2>Complaints List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Complainant Name</th>
                    <th>Crime Type</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>John Doe</td>
                    <td>Theft</td>
                    <td>New York</td>
                    <td>In Progress</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Jane Smith</td>
                    <td>Assault</td>
                    <td>Los Angeles</td>
                    <td>Resolved</td>
                </tr>
            </tbody>
        </table>
    </section>

    <footer>
        <p>For assistance, visit our <a href="help-center.html">Help Center</a>.</p>
    </footer>
</body>
</html>
