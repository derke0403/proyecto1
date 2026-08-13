<?php
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM medicos WHERE id_medico = :id");
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit;
?>