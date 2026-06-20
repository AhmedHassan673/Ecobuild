<?php
// login.php
session_start();
header('Content-Type: application/json');

// Database configuration
$host = 'localhost';
$dbname = 'ecobuild';
$db_username = 'root';
$db_password = '';

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get POST data
    // $username = trim($_POST['username'] ?? '');
    // $password = $_POST['password'] ?? '';
    
    // // Validation
    // if (empty($username) || empty($password)) {
    //     echo json_encode(['success' => false, 'message' => 'Please enter both username and password']);
    //     exit;
    // }
    
    // // Check if user exists (by username or email)
    // $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    // $stmt->execute([$username, $username]);
    // $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // if (!$user) {
    //     echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    //     exit;
    // }
    
    // // Verify password
    // if ($password !== $user['password']) {
    //     echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    //     exit;
    // }
    
    // // Update last login time
    // $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
    // $stmt->execute([$user['id']]);
    
    // Set session variables
    // $_SESSION['user_id'] = $user['id'];
    // $_SESSION['username'] = $user['username'];
    // $_SESSION['full_name'] = $user['full_name'];
    // $_SESSION['email'] = $user['email'];
    
    // echo json_encode([
    //     'success' => true, 
    //     'message' => 'Login successful!',
    //     'user' => [
    //         'id' => $user['id'],
    //         'username' => $user['username'],
    //         'full_name' => $user['full_name']
    //     ]
    // ]);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>