<?php
session_start();
require_once '../config/database.php';

$nombre = $_POST['nombre'];
$principio_activo = $_POST['principio_activo'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$descripcion = $_POST['descripcion'];

$stmt = $pdo->prepare("INSERT INTO medicamentos (nombre, principio_activo, precio, stock, fecha_vencimiento, descripcion) 
                       VALUES (:nombre, :principio_activo, :precio, :stock, :fecha_vencimiento, :descripcion)");
$stmt->execute([
    ':nombre' => $nombre,
    ':principio_activo' => $principio_activo,
    ':precio' => $precio,
    ':stock' => $stock,
    ':fecha_vencimiento' => $fecha_vencimiento,
    ':descripcion' => $descripcion
]);

$_SESSION['success'] = " Medicamento creado correctamente";
header("Location: index.php");
exit;
?>