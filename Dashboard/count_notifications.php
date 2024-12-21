<?php
require_once '../db.php'; // Adjust this to your database connection file

$user_id = $_SESSION['user_id']; // Ensure this is set
try {
    $sql = "SELECT COUNT(*) as unread_count FROM messages WHERE ReceiverID = :user_id AND IsRead = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $unread_count = $result['unread_count'];

    echo json_encode(['success' => true, 'unread_count' => $unread_count]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error counting unread messages.']);
}
?>
