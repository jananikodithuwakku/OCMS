<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Tips & Geolocation Alerts</title>
    
    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="CSS/Tips.css">

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0b2a4d;
            color: #ffffff;
        }

        /* Header */
        header {
            background-color: #051f3a;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            color: white;
        }

        .logo img {
            width: 50px;
            height: 50px;
        }

        h1 {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
        }

        /* Navigation Bar */
        .navbar {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        .navbar li {
            display: inline;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            transition: 0.3s;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #004080;
        }

        /* Sections */
        section {
            padding: 40px 20px;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            color: #ffdd57;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            background-color: rgba(255, 255, 255, 0.1);
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        ul li:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Alerts Section */
        #alerts {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 600px;
        }

        #enable-location {
            background-color: #ffdd57;
            color: #051f3a;
            padding: 12px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #enable-location:hover {
            background-color: #e6c44a;
        }

        /* Footer */
        .footer {
            background-color: #051f3a;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 0.9rem;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="Images/Logo.png" alt="OCMS Logo">
        </div>
        <h1>Online Crime Management System</h1>
        <nav>
            <ul class="navbar">
                <li><a href="Home.php">Home</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="Features.php">Features</a></li>
                <li><a href="Login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Google Translate -->
    <div id="google_translate_element"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en', includedLanguages: 'en,si,ta', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Safety Tips -->
    <section id="safety-tips">
        <h2><i class="fas fa-shield-alt"></i> Safety Tips</h2>
        <ul>
            <li>Stay aware of your surroundings.</li>
            <li>Share your location with trusted contacts.</li>
            <li>Stay in well-lit, populated areas at night.</li>
            <li>Learn basic first aid and self-defense techniques.</li>
        </ul>
    </section>

    <!-- Crime Rate -->
    <section id="crime-rate">
        <h2><i class="fas fa-chart-line"></i> Crime Rate</h2>
        <p>The Western Province, particularly **Colombo**, has the highest crime rate in Sri Lanka.</p>
        <ul>
            <li><strong>Highest crime areas:</strong> Colombo, Gampaha, Kelaniya</li>
            <li><strong>Common crimes:</strong> Violent crimes, drug-related offenses</li>
            <li><strong>Low crime areas:</strong> Jaffna, Mullaitivu, Nuwara Eliya</li>
        </ul>
    </section>

    <!-- Crime Laws -->
    <section id="crime-laws">
        <h2><i class="fas fa-balance-scale"></i> Crime Laws in Sri Lanka</h2>
        <p>Understanding crime laws can help you stay informed.</p>
        <ul>
            <li><strong>Penal Code:</strong> Covers theft, assault, and fraud.</li>
            <li><strong>Code of Criminal Procedure:</strong> Details arrests and trials.</li>
            <li><strong>Dangerous Drugs Ordinance:</strong> Regulates drug-related crimes.</li>
            <li><strong>Cybercrime Law:</strong> Addresses hacking and identity theft.</li>
        </ul>
        <p>Visit the <a href="Legal_Resources.php">Legal Resources</a> page.</p>
    </section>

    <!-- Alerts -->
    <section id="alerts">
        <h2><i class="fas fa-bell"></i> Geolocation Alerts</h2>
        <p>Enable your location to receive alerts for nearby incidents.</p>
        <button id="enable-location">Enable Location Alerts</button>
        <div id="alert-message"></div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>

    <script src="JS/Tips.js"></script>
</body>
</html>
