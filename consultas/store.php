<?php
session_start();
require_once '../config/database.php';

$id_paciente = $_POST['id_paciente'];
$id_medico = $_POST['id_medico'];
$sintomas = $_POST['sintomas'];
$diagnostico = $_POST['diagnostico'];
$notas_medico = $_POST['notas_medico'];

$stmt = $pdo->prepare("INSERT INTO consultas (id_paciente, id_medico, sintomas, diagnostico, notas_medico) 
                       VALUES (:id_paciente, :id_medico, :sintomas, :diagnostico, :notas_medico)");
$stmt->execute([
    ':id_paciente' => $id_paciente,
    ':id_medico' => $id_medico,
    ':sintomas' => $sintomas,
    ':diagnostico' => $diagnostico,
    ':notas_medico' => $notas_medico
]);

$_SESSION['success'] = "✅ Consulta creada correctamente";
header("Location: index.php");
exit;
?>