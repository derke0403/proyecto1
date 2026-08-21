<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM medicamentos WHERE id_medicamento = :id");
$stmt->execute([':id' => $id]);

$_SESSION['success'] = " Medicamento eliminado correctamente";
header("Location: index.php");
exit;
?>