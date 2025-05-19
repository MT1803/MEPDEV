<?php
// Load .env
$envPath = realpath(__DIR__ . '/../../.env');
$dotenv = parse_ini_file($envPath);

// Validate required keys
$required = ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS'];
foreach ($required as $key) {
    if (!isset($dotenv[$key])) {
        die("❌ Missing $key in .env file");
    }
}

// Database config
$host = $dotenv['DB_HOST'];
$db   = $dotenv['DB_NAME'];
$user = $dotenv['DB_USER'];
$pass = $dotenv['DB_PASS'];
$charset = 'utf8mb4';

// DSN and PDO setup
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "✅ Database connected"; // Optional debug
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage());
}
