<?php
session_start();
require_once '../config/database.php';

$id = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$id_medico = $_POST['id_medico'];
$sintomas = $_POST['sintomas'];
$diagnostico = $_POST['diagnostico'];
$notas_medico = $_POST['notas_medico'];
$estado = $_POST['estado'];

$stmt = $pdo->prepare("UPDATE consultas SET id_paciente = :id_paciente, id_medico = :id_medico, 
                       sintomas = :sintomas, diagnostico = :diagnostico, notas_medico = :notas_medico, estado = :estado
                       WHERE id_consulta = :id");
$stmt->execute([
    ':id_paciente' => $id_paciente,
    ':id_medico' => $id_medico,
    ':sintomas' => $sintomas,
    ':diagnostico' => $diagnostico,
    ':notas_medico' => $notas_medico,
    ':estado' => $estado,
    ':id' => $id
]);

$_SESSION['success'] = "✅ Consulta actualizada correctamente";
header("Location: index.php");
exit;
?>