<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center | Online Crime Management System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121f3d; /* Dark blue background */
            color: white;
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

        /* Header */
        .header {
            text-align: center;
            padding: 30px 20px;
        }
        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        /* FAQ Section */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
            background: #1c2b4d; /* Darker blue */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        }
        .faq-item {
            margin-bottom: 20px;
        }
        .faq-question {
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            padding: 12px;
            background: #243b65;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .faq-question:hover {
            background: #2f4a7d;
        }
        .faq-answer {
            display: none;
            padding: 12px;
            font-size: 16px;
            background: #0b172a;
            border-radius: 5px;
            margin-top: 5px;
        }

        /* Additional Help Topics */
        .help-topics {
            max-width: 800px;
            margin: 40px auto;
            text-align: center;
        }
        .help-topics h3 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        .help-topics .btn {
            width: 100%;
            margin-top: 10px;
        }

        /* Footer */
        .footer {
            background-color: #002147;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 40px;
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
                <li><a href="Contact.php" class="active">Contact</a></li>
                <li><a class="nav-link" href="tips.php">Safety Tips</a></li>
            </ul>
        </nav>
    </header>

<!-- Header -->
<div class="header">
    <h1>Help Center</h1>
</div>

<!-- FAQ Section -->
<section class="faq-container">
    <h2 class="text-center mb-4">Frequently Asked Questions</h2>
    
    <div class="faq-item">
        <div class="faq-question">🔹 How can I report a crime?</div>
        <div class="faq-answer">You can report a crime through the "Report Crime" section in your account.</div>
    </div>

    <div class="faq-item">
        <div class="faq-question">🔹 How do geolocation alerts work?</div>
        <div class="faq-answer">Enable location services in your settings to receive real-time crime alerts.</div>
    </div>

    <div class="faq-item">
        <div class="faq-question">🔹 Who can I contact for help?</div>
        <div class="faq-answer">You can contact our support team via the "Contact Support" page.</div>
    </div>

    <div class="faq-item">
        <div class="faq-question">🔹 How secure is my data?</div>
        <div class="faq-answer">We use encryption and secure databases to protect all your personal information.</div>
    </div>
</section>

<!-- Additional Help Topics -->
<section class="help-topics">
    <h3>Need More Help?</h3>
    <a href="report_crime.php" class="btn btn-warning btn-lg">📌 Report a Crime</a>
    <a href="tips.php" class="btn btn-primary btn-lg">🛡 Safety Tips</a>
    <a href="contact.php" class="btn btn-danger btn-lg">📞 Contact Support</a>
</section>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 Online Crime Management System. All Rights Reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- FAQ Toggle Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const questions = document.querySelectorAll(".faq-question");
        
        questions.forEach(question => {
            question.addEventListener("click", function () {
                const answer = this.nextElementSibling;
                answer.style.display = answer.style.display === "block" ? "none" : "block";
            });
        });
    });
</script>

</body>
</html>
