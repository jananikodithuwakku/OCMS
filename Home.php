<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Crime Management System</title>
    <link rel="stylesheet" href="CSS/Home.css">
    <link rel="stylesheet" href="CSS/chatbot.css"> <!-- Chatbot Styles -->
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="Images/Logo.png" >
            <h1>Online Crime Management System</h1>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="Home.php">Home</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="Features.php">Features</a></li>
                <li><a href="About.php">About Us</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Logout.php">Logout</a></li>
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

    <!-- Banner Section -->
    <main>
        <div class="banner-container">
            <h2>Welcome to the Online Crime Management System</h2>
            <p>Streamline crime reporting and tracking for a safer community.</p>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <h2>Our Features</h2>
        <div class="feature">
            <div class="card"><a href="Report_Crime.php">Report Crime</a></div>
            <div class="card"><a href="view-crime-map.php">View Crime Map</a></div>
            <div class="card"><a href="Tips.php">Safety Tips and Geolocation-based Alerts</a></div>
            <div class="card"><a href="citizen_dashboard.php">View Complaints Status</a></div>
        </div>
    </section>   

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h3>Contact Us</h3>
            <form action="Contact.php" method="post" class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </section>

            <!-- Chatbot Icon and Container -->
    <div class="chatbot-icon" id="chatbot-icon">
        <img src="Images/chatbot-icon.png" alt="Chatbot">
    </div>

    <div class="chatbot-container" id="chatbot-container">
        <div class="chat-header">
            <span>Chat with Us</span>
            <button id="close-chatbot">X</button>
        </div>
        <div class="chatbox" id="chatbox"></div>
        <div class="chat-input">
            <input type="text" id="chat-input" placeholder="Ask about OCMS..." required>
            <button id="send-btn">Send</button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
    </footer>

    <script src="JS/chatbot.js"></script> <!-- Chatbot JS -->
</body>
</html>
