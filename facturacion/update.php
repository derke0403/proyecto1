<?php
session_start();
require_once '../config/database.php';

$id = $_POST['id'];
$id_consulta = $_POST['id_consulta'];
$id_paciente = $_POST['id_paciente'];
$monto = $_POST['monto'];
$metodo_pago = $_POST['metodo_pago'];
$estado = $_POST['estado'];
$fecha_pago = $_POST['fecha_pago'];

$stmt = $pdo->prepare("UPDATE facturacion SET id_consulta = :id_consulta, id_paciente = :id_paciente, 
                       monto = :monto, metodo_pago = :metodo_pago, estado = :estado, fecha_pago = :fecha_pago
                       WHERE id_factura = :id");
$stmt->execute([
    ':id_consulta' => $id_consulta,
    ':id_paciente' => $id_paciente,
    ':monto' => $monto,
    ':metodo_pago' => $metodo_pago,
    ':estado' => $estado,
    ':fecha_pago' => $fecha_pago,
    ':id' => $id
]);

$_SESSION['success'] = "Factura actualizada correctamente";
header("Location: index.php");
exit;
?>