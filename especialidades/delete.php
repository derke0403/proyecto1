<?php
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM especialidades WHERE id_especialidad = :id");
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit;
?>