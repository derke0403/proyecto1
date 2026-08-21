<?php
require_once '../config/database.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$licencia_profesional = $_POST['licencia_profesional'];
$id_especialidad = $_POST['id_especialidad'];

$stmt = $pdo->prepare("INSERT INTO medicos (nombre, email, telefono, licencia_profesional, id_especialidad) VALUES (:nombre, :email, :telefono, :licencia_profesional, :id_especialidad)");
$stmt->execute([':nombre' => $nombre, ':email' => $email, ':telefono' => $telefono, ':licencia_profesional' => $licencia_profesional, ':id_especialidad' => $id_especialidad]);
$_SESSION['success'] = " Medico creado correctamente";
header("Location: index.php");
exit;
?>