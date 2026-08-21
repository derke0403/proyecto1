<?php
session_start();
require_once '../config/database.php';

$id_consulta = $_POST['id_consulta'];
$id_paciente = $_POST['id_paciente'];
$monto = $_POST['monto'];
$metodo_pago = $_POST['metodo_pago'];

$stmt = $pdo->prepare("INSERT INTO facturacion (id_consulta, id_paciente, monto, metodo_pago) 
                       VALUES (:id_consulta, :id_paciente, :monto, :metodo_pago)");
$stmt->execute([
    ':id_consulta' => $id_consulta,
    ':id_paciente' => $id_paciente,
    ':monto' => $monto,
    ':metodo_pago' => $metodo_pago
]);

$_SESSION['success'] = "Factura creada correctamente";
header("Location: index.php");
exit;
?>