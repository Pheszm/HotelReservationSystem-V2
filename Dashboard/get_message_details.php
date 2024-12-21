<?php
require_once '../db.php';

$input = json_decode(file_get_contents('php://input'), true);
if (isset($input['id'])) {
    $message_id = intval($input['id']);
    try {
        $sql = "SELECT MessageText FROM messages WHERE MessageID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $message_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'message' => htmlspecialchars($message['MessageText'])]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Message not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching message.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
