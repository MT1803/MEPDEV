<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

// Get language parameter
$lang = $_GET['lang'] ?? 'en';

try {
    // Prepare and execute PDO query
    $stmt = $pdo->prepare("SELECT name, description, image_url FROM projects WHERE lang = ?");
    $stmt->execute([$lang]);
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'data' => $projects]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'DB query failed',
        'details' => $e->getMessage()
    ]);
}
