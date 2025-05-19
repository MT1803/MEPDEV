<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../middleware/auth.php';

header('Content-Type: application/json');

$lang = $_GET['lang'] ?? 'en';

try {
    $stmt = $pdo->prepare("SELECT content FROM about WHERE lang = ?");
    $stmt->execute([$lang]);
    $row = $stmt->fetch();

    if ($row) {
        echo json_encode(['content' => $row['content']]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Content not found for this language.']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
