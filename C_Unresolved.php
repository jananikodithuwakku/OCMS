<?php
include 'database.php'; // Include database connection

session_start();
if (!isset($_SESSION["user"])) {
    $_SESSION["redirect_to"] = $_SERVER["REQUEST_URI"]; // Store current page before login
    header("Location: Unresolved_Login.php");
    exit();
}

// Fetch unresolved cases
$query = "SELECT * FROM cases WHERE status = 'Unresolved'";
$result = $conn->query($query);

// Handle escalation request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['escalate_case'])) {
    $case_id = $_POST['case_id'];
    $reason = $_POST['reason'];

    // Update case to request escalation
    $update_query = "UPDATE cases SET escalation_requested = 1, escalation_reason = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $reason, $case_id);
    $stmt->execute();

    echo "<script>alert('Escalation request submitted successfully!'); window.location.href='C_Track_Unresolved.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unresolved Cases</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/C_Unresolved.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<header>
    <div class="logo">
        <img src="Images/Logo.png" alt="Online Crime Management System">
        <h1>Online Crime Management System</h1>
    </div>
    <nav>
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Features.php">Features</a></li>
            <li><a href="Contact.php">Contact</a></li>
            <li><a href="Logout.php" class="btn btn-danger btn-sm">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="container mt-4">
    <h2 class="text-center">Unresolved Cases</h2>
    
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Case ID</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['description']; ?></td>
                    <td>
                        <span class="badge bg-warning"><?= $row['status']; ?></span>
                    </td>
                    <td>
                        <?php if ($row['escalation_requested'] == 0) { ?>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#escalateModal<?= $row['id']; ?>">Request Escalation</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="escalateModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="escalateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="escalateModalLabel">Request Escalation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post">
                                                <input type="hidden" name="case_id" value="<?= $row['id']; ?>">
                                                <div class="mb-3">
                                                    <label for="reason" class="form-label">Reason for escalation:</label>
                                                    <textarea name="reason" class="form-control" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="escalate_case" class="btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <span class="text-success">Escalation Requested</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
