<?php
require '../config/db.php';

$lang = $_GET['lang'] ?? 'en';

$stmt = $pdo->prepare("SELECT title, description FROM services WHERE lang = ?");
$stmt->execute([$lang]);
$data = $stmt->fetchAll();

echo json_encode($data);
?>
