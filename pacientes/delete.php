<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];

// Por ahora solo elimina el paciente (sin verificar consultas)
$stmt = $pdo->prepare("DELETE FROM pacientes WHERE id_paciente = :id");
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit;
?>