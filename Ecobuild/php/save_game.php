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
    
    $game_state = $_POST['game_state'] ?? '';
    // Fetch stats for leaderboard, default to 0 if missing
    $city_level = $_POST['city_level'] ?? 1;
    $green_score = $_POST['green_score'] ?? 0;
    $money = $_POST['money'] ?? 10000;
    
    if (empty($game_state)) {
        echo json_encode(['success' => false, 'message' => 'No game data provided']);
        exit;
    }
    
    // Check if user exists
    $stmt = $pdo->prepare("SELECT id FROM saved_games WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        // Update
        $stmt = $pdo->prepare("UPDATE saved_games SET game_state = ?, city_level = ?, green_score = ?, money = ?, saved_at = NOW() WHERE user_id = ?");
        $stmt->execute([$game_state, $city_level, $green_score, $money, $_SESSION['user_id']]);
    } else {
        // Insert
        $stmt = $pdo->prepare("INSERT INTO saved_games (user_id, game_state, city_level, green_score, money, saved_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$_SESSION['user_id'], $game_state, $city_level, $green_score, $money]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Game saved successfully']);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>