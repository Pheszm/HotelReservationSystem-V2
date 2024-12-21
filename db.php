<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'HotelReservation';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn; // Store the connection in a global or accessible variable
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
