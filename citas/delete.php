<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM citas WHERE id_cita = :id");
$stmt->execute([':id' => $id]);

$_SESSION['success'] = "✅ Cita eliminada correctamente";
header("Location: index.php");
exit;
?>