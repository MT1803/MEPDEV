<?php
require '../config/db.php';

$lang = $_GET['lang'] ?? 'en';

$stmt = $pdo->prepare("SELECT title, description FROM projects WHERE lang = ?");
$stmt->execute([$lang]);
$data = $stmt->fetchAll();

echo json_encode($data);
?>
