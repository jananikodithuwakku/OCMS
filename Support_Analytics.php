<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If installed via Composer

include 'database.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM contact WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Message deleted successfully'); window.location.href='Support_Analytics.php';</script>";
    }
    $stmt->close();
}

// Handle email sending
if (isset($_POST['send_email'])) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kodithuwakkujanani@gmail.com';
        $mail->Password = 'asna zhzz logq vwsz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'Support Team');
        $mail->addAddress($_POST['email']);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['message'];

        $mail->send();
        echo "<script>alert('Email sent successfully'); window.location.href='Support_Analytics.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Email sending failed: {$mail->ErrorInfo}'); window.location.href='Support_Analytics.php';</script>";
    }
}

// Fetch all messages
$result = $conn->query("SELECT * FROM contact ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - Contact Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
         .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            width: 120px;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #0A1931;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            color: #ffffff;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            background-color: #1B2C53;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="Images/Logo.png" alt="Logo">
        </div>
        <a href="support_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="Support_add_faq.php"><i class="fas fa-robot"></i> Chatbot Update</a>
        <a href="Support_Analytics.php"><i class="fas fa-envelope"></i> Contact Messages</a>
        <a href="Admin_Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2 class="text-center text-primary">Contact Messages</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>  
                    <th>Message</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td> 
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <!-- Delete Button -->
                            <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?');">
                                Delete
                            </a>

                            <!-- Email Button -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#emailModal<?php echo $row['id']; ?>">
                                Email
                            </button>
                            
                            <!-- Email Modal -->
                            <div class="modal fade" id="emailModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Send Email to <?php echo $row['name']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post">
                                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                                <div class="mb-3">
                                                    <label>Subject:</label>
                                                    <input type="text" name="subject" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Message:</label>
                                                    <textarea name="message" class="form-control" rows="4" required></textarea>
                                                </div>
                                                <button type="submit" name="send_email" class="btn btn-success">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Email Modal -->
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
$conn->close();
?>
