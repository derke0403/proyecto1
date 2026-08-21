<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

// Mostrar mensajes
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $_SESSION['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $_SESSION['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    unset($_SESSION['success']);
}

$stmt = $pdo->query("SELECT f.id_factura, f.monto, f.metodo_pago, f.estado, f.fecha_factura, f.fecha_pago, p.nombre as paciente, c.id_consulta
                     FROM facturacion f
                     JOIN pacientes p ON f.id_paciente = p.id_paciente
                     JOIN consultas c ON f.id_consulta = c.id_consulta
                     ORDER BY f.fecha_factura DESC");
$facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="create.php" class="btn btn-primary">Nueva Factura</a>
            </div>
            <div class="col-md-6">
                <div class="float-end">Listado de Facturas</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Consulta ID</th>
                        <th>Paciente</th>
                        <th>Monto</th>
                        <th>Método Pago</th>
                        <th>Estado</th>
                        <th>Fecha Factura</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($facturas as $factura): ?>
                    <tr>
                        <td><?= $factura['id_factura'] ?></td>
                        <td><?= $factura['id_consulta'] ?></td>
                        <td><?= $factura['paciente'] ?></td>
                        <td>S/<?= $factura['monto'] ?></td>
                        <td><?= $factura['metodo_pago'] ?></td>
                        <td><?= $factura['estado'] ?></td>
                        <td><?= $factura['fecha_factura'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $factura['id_factura'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $factura['id_factura'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>