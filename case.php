<?php
session_start();
include 'database.php'; // Connect to database

// Check user role (assuming session stores role)
$user_role = $_SESSION['role'] ?? 'citizen'; // Default role: Citizen
$citizen_id = $_SESSION['user_id'] ?? 0;

// Handle escalation request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['escalate_case'])) {
    $case_id = $_POST['case_id'];
    $reason = $_POST['escalation_reason'];

    $sql = "UPDATE cases SET escalation_requested = 1, escalation_reason = ? WHERE id = ? AND status = 'Unresolved'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $reason, $case_id);
    $stmt->execute();
    header("Location: cases.php");
    exit();
}

// Handle police officer updating a case
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_case'])) {
    $case_id = $_POST['case_id'];
    $new_status = $_POST['new_status'];

    $sql = "UPDATE cases SET status = ?, escalation_requested = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $case_id);
    $stmt->execute();
    header("Location: cases.php");
    exit();
}

// Fetch unresolved cases (citizens view)
$citizen_cases_sql = "SELECT * FROM cases WHERE status = 'Unresolved'";
$citizen_cases_result = $conn->query($citizen_cases_sql);

// Fetch escalated cases (police view)
$police_cases_sql = "SELECT * FROM cases WHERE escalation_requested = 1";
$police_cases_result = $conn->query($police_cases_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { display: inline; }
        .escalate-btn { background-color: orange; color: white; padding: 5px; border: none; cursor: pointer; }
        .update-btn { background-color: green; color: white; padding: 5px; border: none; cursor: pointer; }
    </style>
</head>
<body>

<h2>Unresolved Cases</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $citizen_cases_result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <!-- Citizen can request escalation -->
                <?php if ($user_role == 'citizen' && !$row['escalation_requested']) { ?>
                    <form method="POST">
                        <input type="hidden" name="case_id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="escalation_reason" placeholder="Reason for escalation" required>
                        <button type="submit" name="escalate_case" class="escalate-btn">Request Escalation</button>
                    </form>
                <?php } elseif ($row['escalation_requested']) {
                    echo "<span style='color: red;'>Escalation Requested</span>";
                } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- Police Officer View -->
<?php if ($user_role == 'police') { ?>
    <h2>Escalated Cases</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Reason for Escalation</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $police_cases_result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['escalation_reason']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <!-- Police officer can update status -->
                    <form method="POST">
                        <input type="hidden" name="case_id" value="<?php echo $row['id']; ?>">
                        <select name="new_status" required>
                            <option value="Under Investigation">Under Investigation</option>
                            <option value="Resolved">Resolved</option>
                        </select>
                        <button type="submit" name="update_case" class="update-btn">Update</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

</body>
</html>
