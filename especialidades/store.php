<?php
require_once '../config/database.php';

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$stmt = $pdo->prepare("INSERT INTO especialidades (nombre, descripcion) VALUES (:nombre, :descripcion)");
$stmt->execute([':nombre' => $nombre, ':descripcion' => $descripcion]);

header("Location: index.php");
exit;
?>