<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

// Database configuration
$host = 'localhost';
$dbname = 'ecobuild';
$db_username = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if user has a saved game
    $stmt = $pdo->prepare("SELECT id FROM saved_games WHERE user_id = ? ORDER BY saved_at DESC LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $save = $stmt->fetch();
    
    if ($save) {
        echo json_encode(['has_save' => true]);
    } else {
        echo json_encode(['has_save' => false]);
    }
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>