<?php
include 'database.php';
session_start(); // Start session to track logged-in users

header("Content-Type: application/json");

// Get user input
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = strtolower(trim($data["message"]));

// Check if user is logged in
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
$user_name = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "Guest";

// Default response
$response = "Sorry, I didn't understand that. Try asking about complaint status, crime reporting, or website features.";

// Check if user asks for complaint status
if (strpos($userMessage, "status") !== false || strpos($userMessage, "complaint") !== false) {
    preg_match('/\d+/', $userMessage, $matches);
    if (!empty($matches[0])) {
        $complaint_id = intval($matches[0]);

        // Retrieve complaint status
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

// FAQs
} else {
    $faqs = [
        "how to report a crime" => "To report a crime, go to the 'Report Crime' section and fill out the required details.",
        "how to check complaint status" => "Check your complaint status under 'View Complaints Status' by entering your Complaint ID.",
        "what is this website about" => "This website helps users report crimes and track complaint progress.",
        "how to use the crime map" => "Click 'View Crime Map' to see crime statistics in your area.",
        "how do i contact the police" => "Find police contact details in the 'Contact Us' section."
    ];

    foreach ($faqs as $question => $answer) {
        if (strpos($userMessage, $question) !== false) {
            $response = $answer;
            break;
        }
    }
}

// Store chat in database
$sql = "INSERT INTO chat_history (user_id, user_name, message, response) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "isss", $user_id, $user_name, $userMessage, $response);
mysqli_stmt_execute($stmt);

// Send response
echo json_encode(["reply" => $response]);
?>
