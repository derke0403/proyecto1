<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM consultas WHERE id_consulta = :id");
$stmt->execute([':id' => $id]);

$_SESSION['success'] = "✅ Consulta eliminada correctamente";
header("Location: index.php");
exit;
?>