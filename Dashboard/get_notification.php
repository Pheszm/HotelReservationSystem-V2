<?php
// Include database connection
require_once '../db.php';

// Get the JSON payload
$input = json_decode(file_get_contents('php://input'), true);

// Validate and fetch notification
if (isset($input['id'])) {
    $notification_id = intval($input['id']);

    try {
        $sql = "SELECT Title, Message, CreatedAt FROM notifications WHERE NotificationID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $notification_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $notification = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode([
                'success' => true,
                'title' => htmlspecialchars($notification['Title']),
                'message' => htmlspecialchars($notification['Message']),
                'created_at' => $notification['CreatedAt']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Notification not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching notification.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
