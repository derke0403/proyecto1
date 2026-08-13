<?php
require_once '../config/database.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$licencia_profesional = $_POST['licencia_profesional'];
$id_especialidad = $_POST['id_especialidad'];

$stmt = $pdo->prepare("UPDATE medicos SET nombre = :nombre, email = :email, telefono = :telefono, licencia_profesional = :licencia_profesional, id_especialidad = :id_especialidad WHERE id_medico = :id");
$stmt->execute([':nombre' => $nombre, ':email' => $email, ':telefono' => $telefono, ':licencia_profesional' => $licencia_profesional, ':id_especialidad' => $id_especialidad, ':id' => $id]);

header("Location: index.php");
exit;
?>