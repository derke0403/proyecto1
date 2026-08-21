<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM recetas WHERE id_receta = :id");
$stmt->execute([':id' => $id]);

$_SESSION['success'] = "Receta eliminada correctamente";
header("Location: index.php");
exit;
?>