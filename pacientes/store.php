<?php
session_start();
require_once '../config/database.php';

$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = $_POST['direccion'];
$alergias = $_POST['alergias'];
$tipo_sangre = $_POST['tipo_sangre'];

$stmt = $pdo->prepare("INSERT INTO pacientes (nombre, dni, email, telefono, fecha_nacimiento, direccion, alergias, tipo_sangre) 
                       VALUES (:nombre, :dni, :email, :telefono, :fecha_nacimiento, :direccion, :alergias, :tipo_sangre)");
$stmt->execute([
    ':nombre' => $nombre,
    ':dni' => $dni,
    ':email' => $email,
    ':telefono' => $telefono,
    ':fecha_nacimiento' => $fecha_nacimiento,
    ':direccion' => $direccion,
    ':alergias' => $alergias,
    ':tipo_sangre' => $tipo_sangre
]);

$_SESSION['success'] = "Paciente creado correctamente";
header("Location: index.php");
exit;
?>