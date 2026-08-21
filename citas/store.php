<?php
session_start();
require_once '../config/database.php';

$id_paciente = $_POST['id_paciente'];
$id_medico = $_POST['id_medico'];
$fecha_hora = $_POST['fecha_hora'];
$motivo = $_POST['motivo'];

$stmt = $pdo->prepare("INSERT INTO citas (id_paciente, id_medico, fecha_hora, motivo) 
                       VALUES (:id_paciente, :id_medico, :fecha_hora, :motivo)");
$stmt->execute([
    ':id_paciente' => $id_paciente,
    ':id_medico' => $id_medico,
    ':fecha_hora' => $fecha_hora,
    ':motivo' => $motivo
]);

$_SESSION['success'] = "✅ Cita creada correctamente";
header("Location: index.php");
exit;
?>