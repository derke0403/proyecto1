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

$stmt = $pdo->query("SELECT * FROM medicamentos ORDER BY nombre");
$medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="create.php" class="btn btn-primary">Nuevo Medicamento</a>
            </div>
            <div class="col-md-6">
                <div class="float-end">Listado de Medicamentos</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Principio Activo</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Fecha Vencimiento</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicamentos as $medicamento): ?>
                    <tr>
                        <td><?= $medicamento['id_medicamento'] ?></td>
                        <td><?= $medicamento['nombre'] ?></td>
                        <td><?= $medicamento['principio_activo'] ?></td>
                        <td>S/<?= $medicamento['precio'] ?></td>
                        <td><?= $medicamento['stock'] ?></td>
                        <td><?= $medicamento['fecha_vencimiento'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $medicamento['id_medicamento'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $medicamento['id_medicamento'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>