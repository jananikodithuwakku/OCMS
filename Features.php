<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - Online Crime Management System</title>
    
    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Styles -->
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
            font-size: 2.5rem;
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
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.4);
        }

        .feature-card a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .feature-card i {
            font-size: 2.5rem;
            color: #ffdd57;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
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
                    <a href="Report_Crime.php">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3>Report Crime</h3>
                        <p>Users can report crimes online, providing detailed information and evidence.</p>
                    </a>
                </div>

                <div class="feature-card">
                    <a href="view-crime-map.php">
                        <i class="fas fa-map-marked-alt"></i>
                        <h3>View Crime Map</h3>
                        <p>Interactive crime map to track criminal activities in different locations.</p>
                    </a>
                </div>

                <div class="feature-card">
                    <a href="track_complaint.php">
                        <i class="fas fa-search"></i>
                        <h3>Case Tracking</h3>
                        <p>Users can track the progress of their crime reports and receive updates.</p>
                    </a>
                </div>

                <div class="feature-card">
                    <a href="Tips.php">
                        <i class="fas fa-bell"></i>
                        <h3>Geolocation Alerts</h3>
                        <p>Receive location-based alerts and safety notifications.</p>
                    </a>
                </div>

                <div class="feature-card">
                    <a href="role_based_access.html">
                        <i class="fas fa-user-lock"></i>
                        <h3>Role-Based Access</h3>
                        <p>Secure access for citizens, police officers, and administrators.</p>
                    </a>
                </div>

                <div class="feature-card">
                    <a href="Home.php">
                        <i class="fas fa-robot"></i>
                        <h3>Chatbot Assistance</h3>
                        <p>Provides support and assistance via AI-driven chatbot.</p>
                    </a>
                </div>

                <div class="feature-card">
                    <a href="C_Unresolved.php">
                        <i class="fas fa-exclamation-circle"></i>
                        <h3>Unresolved Cases</h3>
                        <p>Users can request escalation and track their progress.</p>
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
