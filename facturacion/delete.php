<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM facturacion WHERE id_factura = :id");
$stmt->execute([':id' => $id]);

$_SESSION['success'] = " Factura eliminada correctamente";
header("Location: index.php");
exit;
?>