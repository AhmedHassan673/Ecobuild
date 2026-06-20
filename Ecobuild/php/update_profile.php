
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
    
    $updates = [];
    $params = [];
    
    // Update username if provided
    if (!empty($_POST['username'])) {
        $newUsername = trim($_POST['username']);
        
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
        $stmt->execute([$newUsername, $_SESSION['user_id']]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Username already taken']);
            exit;
        }
        
        $updates[] = "username = ?";
        $params[] = $newUsername;
        $_SESSION['username'] = $newUsername;
    }
    
    // Update password if provided
    if (!empty($_POST['password'])) {
        $updates[] = "password = ?";
        $params[] = $_POST['password'];
    }
    
    if (empty($updates)) {
        echo json_encode(['success' => false, 'message' => 'No changes to save']);
        exit;
    }
    
    $params[] = $_SESSION['user_id'];
    $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
