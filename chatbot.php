<?php
include 'database.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$userMessage = strtolower(trim($data["message"]));

$response = "Sorry, I didn't understand that.";

if (strpos($userMessage, "status") !== false || strpos($userMessage, "complaint") !== false) {
    // Extract Complaint ID if mentioned
    preg_match('/\d+/', $userMessage, $matches);
    if (!empty($matches[0])) {
        $complaint_id = intval($matches[0]);

        // Fetch complaint status
        $sql = "SELECT status FROM crime_reports WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $complaint_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $response = "Your complaint (ID: $complaint_id) status is: " . $row["status"];
        } else {
            $response = "No complaint found with ID: $complaint_id.";
        }
    } else {
        $response = "Please provide your Complaint ID (e.g., 'Check status of complaint 5').";
    }
} elseif (strpos($userMessage, "hello") !== false) {
    $response = "Hello! How can I assist you with your complaint today?";
} elseif (strpos($userMessage, "help") !== false) {
    $response = "You can ask about your complaint status. Example: 'Check status of complaint 3'.";
}

echo json_encode(["reply" => $response]);
?>
