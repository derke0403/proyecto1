<?php
session_start();
require_once '../config/database.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$principio_activo = $_POST['principio_activo'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$descripcion = $_POST['descripcion'];

$stmt = $pdo->prepare("UPDATE medicamentos SET nombre = :nombre, principio_activo = :principio_activo, 
                       precio = :precio, stock = :stock, fecha_vencimiento = :fecha_vencimiento, descripcion = :descripcion
                       WHERE id_medicamento = :id");
$stmt->execute([
    ':nombre' => $nombre,
    ':principio_activo' => $principio_activo,
    ':precio' => $precio,
    ':stock' => $stock,
    ':fecha_vencimiento' => $fecha_vencimiento,
    ':descripcion' => $descripcion,
    ':id' => $id
]);

$_SESSION['success'] = " Medicamento actualizado correctamente";
header("Location: index.php");
exit;
?>