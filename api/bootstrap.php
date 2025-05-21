<?php
// Manually load .env file
function loadEnv($path)
{
    if (!file_exists($path)) return;

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value, '"\'');
        $_ENV[$name] = $value;
    }
}

loadEnv(__DIR__ . '/../.env');

define('APP_ENV', $_ENV['APP_ENV'] ?? 'production');
define('APP_VERSION', $_ENV['APP_VERSION'] ?? '1.0.0');
define('APP_KEY', $_ENV['APP_KEY'] ?? '');

// Choose DB based on environment
if (APP_ENV === 'local') {
    define('DB_HOST', $_ENV['DB_LOCAL_HOST']);
    define('DB_PORT', $_ENV['DB_LOCAL_PORT']);
    define('DB_NAME', $_ENV['DB_LOCAL_NAME']);
    define('DB_USER', $_ENV['DB_LOCAL_USER']);
    define('DB_PASSWORD', $_ENV['DB_LOCAL_PASSWORD']);
} else {
    define('DB_HOST', $_ENV['DB_PROD_HOST']);
    define('DB_PORT', $_ENV['DB_PROD_PORT']);
    define('DB_NAME', $_ENV['DB_PROD_NAME']);
    define('DB_USER', $_ENV['DB_PROD_USER']);
    define('DB_PASSWORD', $_ENV['DB_PROD_PASSWORD']);
}
