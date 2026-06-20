
<?php
session_start();
header('Content-Type: application/json');

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
    
    // Get the most recent saved game for this user
    $stmt = $pdo->prepare("SELECT game_state FROM saved_games WHERE user_id = ? ORDER BY saved_at DESC LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $save = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($save) {
        echo json_encode([
            'success' => true,
            'game_state' => $save['game_state']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No saved game found'
        ]);
    }
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>