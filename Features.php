<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - Online Crime Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0b2a4d;
            color: #ffffff;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        /* Navigation Bar */
        .navbar {
            background-color: #021027;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .logo span {
            font-size: 1.2rem;
            font-weight: bold;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            transition: 0.3s;
        }
        nav ul li a:hover,
        nav ul li a.active {
            background-color: #0056b3;
            border-radius: 5px;
        }
        /* Features Section */
        .features {
            background-color: #0b2a4d;
            padding: 3rem 0;
            text-align: center;
        }
        .features h2 {
            font-size: 2rem;
            color: #ffdd57;
            margin-bottom: 2rem;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 0 2rem;
        }
        .feature-card {
            background-color: #003366;
            padding: 1.5rem;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        .feature-card a {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .feature-card h3 {
            font-size: 1.25rem;
            color: #ffdd57;
            margin-bottom: 0.5rem;
        }
        .feature-card p {
            color: #ffffff;
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
                <li><a href="contact.html">Contact</a></li>
                <li><a href="Features.php" class="active">Features</a></li>
                <li><a href="Login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Our Features</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <a href="report_crime.html">
                        <h3>Report Crime</h3>
                        <p>Users can report crimes online, providing detailed information and evidence.</p>
                    </a>
                </div>
                <div class="feature-card">
                    <a href="crime_map.html">
                        <h3>View Crime Map</h3>
                        <p>Interactive crime map to track criminal activities in different locations.</p>
                    </a>
                </div>
                <div class="feature-card">
                    <a href="case_tracking.html">
                        <h3>Case Tracking</h3>
                        <p>Users can track the progress of their crime reports and receive updates.</p>
                    </a>
                </div>
                <div class="feature-card">
                    <a href="geolocation_alerts.html">
                        <h3>Geolocation Alerts</h3>
                        <p>Receive location-based alerts and safety notifications.</p>
                    </a>
                </div>
                <div class="feature-card">
                    <a href="role_based_access.html">
                        <h3>Role-Based Access</h3>
                        <p>Secure access for citizens, police officers, and administrators.</p>
                    </a>
                </div>
                <div class="feature-card">
                    <a href="chatbot_assistance.html">
                        <h3>Chatbot Assistance</h3>
                        <p>Provides support and assistance via AI-driven chatbot.</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
