<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Tips and Geolocation Alerts</title>
    <link rel="stylesheet" href="CSS/Tips.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Images/Logo.png" alt="Logo">
        </div>
        <h1> Online Crime Management System </h1>
        <nav>
            <ul class="navbar">
                <li><a href="Home.html">Home</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </nav>
    </header>

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


    <section id="safety-tips">
        <h2>Safety Tips</h2>
        <ul>
            <li>Stay aware of your surroundings.</li>
            <li>Share your location with trusted contacts.</li>
            <li>Stay in well-lit, populated areas at night.</li>
            <li>Learn basic first aid and self-defense techniques.</li>
        </ul>
    </section>

    <section id="alerts">
        <h2>Geolocation-based Alerts</h2>
        <p>Enable your location to receive alerts for nearby incidents.</p>
        <button id="enable-location">Enable Location Alerts</button>
        <div id="alert-message"></div>
    </section>

    <footer>
        <p>For more information, visit our <a href="help_center.html">Help Center</a>.</p>
    </footer>

    <script src="Tips.js"></script>
</body>
</html>
