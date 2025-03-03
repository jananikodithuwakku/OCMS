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
                <li><a href="Home.php">Home</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="Features.php">Features</a></li>
                <li><a href="Login.php">Login</a></li>
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

    <section id="crime-rate">
        <h2>Crime Rate</h2>
        <p>According to available data, the Western Province, particularly the Colombo district, has the highest crime rate in Sri Lanka, with a significant portion of the country's total grave crimes occurring within this area; other districts with relatively higher crime rates include Gampaha, Kurunegala, and Kalutara, while the Northern and Eastern Provinces generally report lower crime rates. </p>
        <ul>
            <li><strong>Key points about Sri Lankan crime rates by district:</strong></li>
            <ul><li>01. Highest crime areas: <strong>Colombo, Gampaha, Kelaniya (within Colombo)</strong></li></ul>
            <ul><li>02. Crimes most prevalent in these areas: <strong>Violent crimes, property crimes, drug related offenses </strong></li></ul>
            <ul><li>03. Factors contributing to high crime rates: <strong>Urban density, poverty, unemployment</strong></li></ul>
            <ul><li>04. Districts with lower crime rates: Jaffna, <strong>Mullaitivu, Nuwara Eliya, Badulla </strong></li></ul>
        </ul>
    </section>

    <section id="crime-laws">
        <h2>Crime Laws in Sri Lanka</h2>
        <p>Understanding crime laws can help you stay informed and protected. Below are key laws governing crime in Sri Lanka:</p>
        <ul>
            <li><strong>01. Penal Code of Sri Lanka:</strong> Covers crimes like murder, theft, assault, and fraud.</li>
            <li><strong>02. Code of Criminal Procedure Act:</strong> Outlines legal procedures for arrests, investigations, and trials.</li>
            <li><strong>03. Dangerous Drugs Ordinance:</strong> Regulates drug-related offenses with strict penalties.</li>
            <li><strong>04. Prevention of Terrorism Act (PTA):</strong> Governs offenses related to terrorism.</li>
            <li><strong>05. Computer Crimes Act:</strong> Addresses cybercrimes like hacking and identity theft.</li>
            <li><strong>06. Bribery Act:</strong> Criminalizes corruption and misuse of public office.</li>
            <li><strong>07. Domestic Violence Act:</strong> Protects victims of abuse with legal safeguards.</li>
            <li><strong>08. Child Protection Laws:</strong> Prevents child labor, abuse, and exploitation.</li>
            <li><strong>09. Money Laundering Act:</strong> Criminalizes illegal financial transactions.</li>
            <li><strong>10. Human Trafficking Laws:</strong> Prohibits forced labor and exploitation.</li>
        </ul>
        <p>For more details, visit the <a href="Legal_Resources.php">Legal Resources</a> page.</p>
    </section>

    <section id="alerts">
        <h2>Geolocation-based Alerts</h2>
        <p>Enable your location to receive alerts for nearby incidents.</p>
        <button id="enable-location">Enable Location Alerts</button>
        <div id="alert-message"></div>
    </section>

    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>

    <script src="JS/Tips.js"></script>
</body>
</html>