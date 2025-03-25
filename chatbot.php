<?php
include 'database.php'; // Ensure database connection
header("Content-Type: application/json");

// Get user input
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = strtolower(trim($data["message"]));

$response = "I'm sorry, I couldn't find an answer. Try asking about crime reporting, complaint tracking, or website features.";

// **Check FAQ database**
$stmt = $conn->prepare("SELECT answer FROM faqs WHERE ? LIKE CONCAT('%', keywords, '%')");
$stmt->bind_param("s", $userMessage);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response = $row["answer"];
} else {
    // **Check if user asks about complaint status**
    if (strpos($userMessage, "status") !== false || strpos($userMessage, "complaint") !== false) {
        preg_match('/\d+/', $userMessage, $matches);
        if (!empty($matches[0])) {
            $complaint_id = intval($matches[0]);

            // Fetch complaint status
            $stmt = $conn->prepare("SELECT status FROM crime_reports WHERE id = ?");
            $stmt->bind_param("i", $complaint_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $response = "Your complaint (ID: $complaint_id) status is: " . $row["status"];
            } else {
                $response = "No complaint found with ID: $complaint_id.";
            }
        } else {
            $response = "Please provide your Complaint ID (e.g., 'Check status of complaint 3').";
        }
    }
}

// **Save conversation in chatbot_logs**
$stmt = $conn->prepare("INSERT INTO chatbot_logs (user_question, bot_response) VALUES (?, ?)");
$stmt->bind_param("ss", $userMessage, $response);
$stmt->execute();

// Send response
echo json_encode(["reply" => $response]);

// Close connections
$stmt->close();
$conn->close();
?>
