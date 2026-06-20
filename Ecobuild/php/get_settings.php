
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
    
    $stmt = $pdo->prepare("SELECT * FROM settings WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($settings) {
        echo json_encode([
            'success' => true,
            'settings' => [
                'audio' => (bool)$settings['audio'],
                'difficulty' => $settings['difficulty'],
                'graphics' => $settings['graphics'],
                'key_sensitivity' => (int)$settings['key_sensitivity']
            ]
        ]);
    } else {
        // Return defaults if no settings exist
        echo json_encode([
            'success' => true,
            'settings' => [
                'audio' => true,
                'difficulty' => 'normal',
                'graphics' => 'medium',
                'key_sensitivity' => 5
            ]
        ]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>