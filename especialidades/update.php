<?php
require_once '../config/database.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$stmt = $pdo->prepare("UPDATE especialidades SET nombre = :nombre, descripcion = :descripcion WHERE id_especialidad = :id");
$stmt->execute([':nombre' => $nombre, ':descripcion' => $descripcion, ':id' => $id]);

header("Location: index.php");
exit;
?>