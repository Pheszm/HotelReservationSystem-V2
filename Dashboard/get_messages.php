<?php
session_start();
$user_id = $_SESSION['user_id']; // Assuming you are storing user ID in session

// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'database_name');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch messages
$sql = "SELECT MessageID, SenderName, MessageText, CreatedAt, IsRead FROM messages WHERE ReceiverID = ? ORDER BY CreatedAt DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

$response = [
    'messages' => $messages,
    'unreadCount' => count(array_filter($messages, function ($message) {
        return $message['IsRead'] === 0;
    }))
];

echo json_encode($response);

$stmt->close();
$conn->close();
?>
