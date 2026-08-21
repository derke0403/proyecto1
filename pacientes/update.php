<?php
session_start();
require_once '../config/database.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = $_POST['direccion'];
$alergias = $_POST['alergias'];
$tipo_sangre = $_POST['tipo_sangre'];

$stmt = $pdo->prepare("UPDATE pacientes SET nombre = :nombre, dni = :dni, email = :email, telefono = :telefono, 
                       fecha_nacimiento = :fecha_nacimiento, direccion = :direccion, razon_consulta = :razon_consulta, 
                       alergias = :alergias, tipo_sangre = :tipo_sangre 
                       WHERE id_paciente = :id");
$stmt->execute([
    ':nombre' => $nombre,
    ':dni' => $dni,
    ':email' => $email,
    ':telefono' => $telefono,
    ':fecha_nacimiento' => $fecha_nacimiento,
    ':direccion' => $direccion,
    ':alergias' => $alergias,
    ':tipo_sangre' => $tipo_sangre,
    ':id' => $id
]);
$_SESSION['success'] = " Paciente actualizado correctamente";
header("Location: index.php");
exit;
?>