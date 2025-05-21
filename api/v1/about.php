<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

// Get language from query parameter or default to 'en'
$lang = $_GET['lang'] ?? 'en';

try {
    // Prepare and execute the query using PDO
    $stmt = $pdo->prepare("SELECT content FROM about WHERE lang = ?");
    $stmt->execute([$lang]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'data' => $data]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'DB query failed',
        'details' => $e->getMessage()
    ]);
}
