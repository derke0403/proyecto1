<?php
session_start();
require_once '../config/database.php';

$id = $_POST['id'];
$id_consulta = $_POST['id_consulta'];
$id_medicamento = $_POST['id_medicamento'];
$dosis = $_POST['dosis'];
$duracion = $_POST['duracion'];
$indicaciones = $_POST['indicaciones'];

$stmt = $pdo->prepare("UPDATE recetas SET id_consulta = :id_consulta, id_medicamento = :id_medicamento, 
                       dosis = :dosis, duracion = :duracion, indicaciones = :indicaciones
                       WHERE id_receta = :id");
$stmt->execute([
    ':id_consulta' => $id_consulta,
    ':id_medicamento' => $id_medicamento,
    ':dosis' => $dosis,
    ':duracion' => $duracion,
    ':indicaciones' => $indicaciones,
    ':id' => $id
]);

$_SESSION['success'] = "Receta actualizada correctamente";
header("Location: index.php");
exit;
?>