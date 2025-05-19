<?php
$headers = getallheaders();

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Missing Authorization Header']);
    exit;
}

$authHeader = $headers['Authorization'];
$expectedKey = 'Bearer ' . $dotenv['API_KEY'];

if ($authHeader !== $expectedKey) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid API Key']);
    exit;
}