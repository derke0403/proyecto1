<?php
session_start();
require_once '../config/database.php';

$id_consulta = $_POST['id_consulta'];
$id_medicamento = $_POST['id_medicamento'];
$dosis = $_POST['dosis'];
$duracion = $_POST['duracion'];
$indicaciones = $_POST['indicaciones'];

$stmt = $pdo->prepare("INSERT INTO recetas (id_consulta, id_medicamento, dosis, duracion, indicaciones) 
                       VALUES (:id_consulta, :id_medicamento, :dosis, :duracion, :indicaciones)");
$stmt->execute([
    ':id_consulta' => $id_consulta,
    ':id_medicamento' => $id_medicamento,
    ':dosis' => $dosis,
    ':duracion' => $duracion,
    ':indicaciones' => $indicaciones
]);

$_SESSION['success'] = " Receta creada correctamente";
header("Location: index.php");
exit;
?>