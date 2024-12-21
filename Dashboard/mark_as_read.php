<?php
// Include database connection
require_once '../db.php';

// Get the JSON payload
$input = json_decode(file_get_contents('php://input'), true);

// Validate and mark as read
if (isset($input['id'])) {
    $notification_id = intval($input['id']);

    try {
        $sql = "UPDATE notifications SET IsRead = 1 WHERE NotificationID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $notification_id, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Notification marked as read.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error updating notification.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
