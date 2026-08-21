<?php
session_start();
require_once '../config/database.php';

$id = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$id_medico = $_POST['id_medico'];
$fecha_hora = $_POST['fecha_hora'];
$motivo = $_POST['motivo'];
$estado = $_POST['estado'];

$stmt = $pdo->prepare("UPDATE citas SET id_paciente = :id_paciente, id_medico = :id_medico, 
                       fecha_hora = :fecha_hora, motivo = :motivo, estado = :estado 
                       WHERE id_cita = :id");
$stmt->execute([
    ':id_paciente' => $id_paciente,
    ':id_medico' => $id_medico,
    ':fecha_hora' => $fecha_hora,
    ':motivo' => $motivo,
    ':estado' => $estado,
    ':id' => $id
]);

$_SESSION['success'] = "✅ Cita actualizada correctamente";
header("Location: index.php");
exit;
?>