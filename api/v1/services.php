<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

// Get language parameter from query string
$lang = $_GET['lang'] ?? 'en';

try {
    // Prepare and execute query using PDO
    $stmt = $pdo->prepare("SELECT title, description FROM services WHERE lang = ?");
    $stmt->execute([$lang]);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'data' => $services]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'DB query failed']);
}