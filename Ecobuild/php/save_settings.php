
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
    
    $audio = isset($_POST['audio']) ? (int)$_POST['audio'] : 1;
    $difficulty = $_POST['difficulty'] ?? 'normal';
    $graphics = $_POST['graphics'] ?? 'medium';
    $key_sensitivity = (int)($_POST['key_sensitivity'] ?? 5);
    
    // Check if settings exist
    $stmt = $pdo->prepare("SELECT id FROM settings WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    
    if ($stmt->fetch()) {
        // Update existing settings
        $stmt = $pdo->prepare("UPDATE settings SET audio = ?, difficulty = ?, graphics = ?, key_sensitivity = ? WHERE user_id = ?");
        $stmt->execute([$audio, $difficulty, $graphics, $key_sensitivity, $_SESSION['user_id']]);
    } else {
        // Insert new settings
        $stmt = $pdo->prepare("INSERT INTO settings (user_id, audio, difficulty, graphics, key_sensitivity) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $audio, $difficulty, $graphics, $key_sensitivity]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Settings saved successfully']);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>