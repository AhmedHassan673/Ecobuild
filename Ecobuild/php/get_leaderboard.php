<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'ecobuild';
$db_username = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sort = $_GET['sort'] ?? 'score';
    $orderBy = 'green_score';
    
    // Whitelist sort columns to prevent SQL injection
    if ($sort === 'level') $orderBy = 'city_level';
    else if ($sort === 'money') $orderBy = 'money';
    
    // Join users and saved_games to get username + stats
    $sql = "SELECT u.username, s.city_level, s.green_score, s.money 
            FROM saved_games s 
            JOIN users u ON s.user_id = u.id 
            ORDER BY $orderBy DESC 
            LIMIT 10";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($results);
    
} catch (PDOException $e) {
    echo json_encode([]);
}
?>