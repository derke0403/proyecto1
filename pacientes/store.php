<?php
session_start();
require_once '../config/database.php';

$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = $_POST['direccion'];
$razon_consulta = $_POST['razon_consulta'];
$alergias = $_POST['alergias'];
$tipo_sangre = $_POST['tipo_sangre'];

$stmt = $pdo->prepare("INSERT INTO pacientes (nombre, dni, email, telefono, fecha_nacimiento, direccion, razon_consulta, alergias, tipo_sangre) 
                       VALUES (:nombre, :dni, :email, :telefono, :fecha_nacimiento, :direccion, :razon_consulta, :alergias, :tipo_sangre)");
$stmt->execute([
    ':nombre' => $nombre,
    ':dni' => $dni,
    ':email' => $email,
    ':telefono' => $telefono,
    ':fecha_nacimiento' => $fecha_nacimiento,
    ':direccion' => $direccion,
    ':razon_consulta' => $razon_consulta,
    ':alergias' => $alergias,
    ':tipo_sangre' => $tipo_sangre
]);

header("Location: index.php");
exit;
?>