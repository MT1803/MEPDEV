<?php
// database.php

// This file assumes bootstrap.php is already loaded before it,
// which defines DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_PORT

$charset = 'utf8mb4';
$port = defined('DB_PORT') ? DB_PORT : 3306;

$dsn = "mysql:host=" . DB_HOST . ";port=$port;dbname=" . DB_NAME . ";charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage());
}
