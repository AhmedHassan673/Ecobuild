<?php
// php/delete_account.php
session_start();
header('Content-Type: application/json');

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$host = 'localhost';
$dbname = 'ecobuild';
$db_username = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $userId = $_SESSION['user_id'];
    
    // Begin Transaction to ensure all data is removed
    $pdo->beginTransaction();

    // 1. Delete Settings
    $stmt = $pdo->prepare("DELETE FROM settings WHERE user_id = ?");
    $stmt->execute([$userId]);

    // 2. Delete Saved Games
    $stmt = $pdo->prepare("DELETE FROM saved_games WHERE user_id = ?");
    $stmt->execute([$userId]);

    // 3. Delete User Account
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);

    $pdo->commit();
    
    // Destroy Session
    session_unset();
    session_destroy();
    
    echo json_encode(['success' => true, 'message' => 'Account deleted successfully']);

} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>