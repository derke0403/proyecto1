<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];

// Primero verificar si hay médicos con esta especialidad
$stmt = $pdo->prepare("SELECT COUNT(*) as total FROM medicos WHERE id_especialidad = :id");
$stmt->execute([':id' => $id]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado['total'] > 0) {
    // Hay médicos, no se puede eliminar
    $_SESSION['error'] = "No puedes eliminar esta especialidad porque hay " . $resultado['total'] . " médico(s) asignado(s). Primero debes eliminar o reasignar los médicos.";
    header("Location: index.php");
    exit;
}

// Si no hay médicos, eliminar la especialidad
$stmt = $pdo->prepare("DELETE FROM especialidades WHERE id_especialidad = :id");
$stmt->execute([':id' => $id]);
$_SESSION['success'] = " Especialidad eliminado correctamente";

header("Location: index.php");
exit;
?>