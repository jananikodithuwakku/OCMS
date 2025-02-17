<?php
include 'database.php';
header("Content-Type: application/json");

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Validate input
if (!isset($data["message"]) || empty(trim($data["message"]))) {
    echo json_encode(["reply" => "Invalid input. Please type a message."]);
    exit;
}

$userMessage = strtolower(trim($data["message"]));
$response = "Sorry, I didn't understand that. You can ask about your complaint status or website features.";

// Check if user is asking about complaint status
if (strpos($userMessage, "status") !== false || strpos($userMessage, "complaint") !== false) {
    preg_match('/\d+/', $userMessage, $matches);
    if (!empty($matches[0])) {
        $complaint_id = intval($matches[0]);

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

// Handle website-related questions
} elseif (strpos($userMessage, "hello") !== false) {
    $response = "Hello! How can I assist you today? You can ask about complaints or website features.";

} elseif (strpos($userMessage, "help") !== false) {
    $response = "You can ask me about:\n- Complaint status (e.g., 'Check status of complaint 5')\n- Website features (e.g., 'What can I do here?')";

} elseif (strpos($userMessage, "features") !== false || strpos($userMessage, "what can i do") !== false) {
    $response = "This website allows you to:\n1️⃣ Report a crime\n2️⃣ View the crime map\n3️⃣ Get safety tips and alerts\n4️⃣ Check the status of complaints";

} elseif (strpos($userMessage, "how to report") !== false || strpos($userMessage, "report crime") !== false) {
    $response = "To report a crime, go to the 'Report Crime' page and fill out the required details. Our team will review your report and take necessary actions.";

} elseif (strpos($userMessage, "crime map") !== false) {
    $response = "You can view crime statistics on our 'Crime Map' page. It helps you stay informed about crime activity in your area.";

} elseif (strpos($userMessage, "safety tips") !== false) {
    $response = "Visit the 'Safety Tips' page to get geolocation-based alerts and crime prevention advice.";

} elseif (strpos($userMessage, "contact") !== false) {
    $response = "To contact us, visit the 'Contact' page and submit your inquiry. We’ll get back to you soon.";

}

echo json_encode(["reply" => $response]);
?>
