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

$stmt = $pdo->query("SELECT r.id_receta, r.dosis, r.duracion, r.fecha_creacion, m.nombre as medicamento, c.id_consulta
                     FROM recetas r
                     JOIN medicamentos m ON r.id_medicamento = m.id_medicamento
                     JOIN consultas c ON r.id_consulta = c.id_consulta
                     ORDER BY r.fecha_creacion DESC");
$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="create.php" class="btn btn-primary">Nueva Receta</a>
            </div>
            <div class="col-md-6">
                <div class="float-end">Listado de Recetas</div>
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
                        <th>Medicamento</th>
                        <th>Dosis</th>
                        <th>Duración</th>
                        <th>Fecha Creación</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recetas as $receta): ?>
                    <tr>
                        <td><?= $receta['id_receta'] ?></td>
                        <td><?= $receta['id_consulta'] ?></td>
                        <td><?= $receta['medicamento'] ?></td>
                        <td><?= $receta['dosis'] ?></td>
                        <td><?= $receta['duracion'] ?></td>
                        <td><?= $receta['fecha_creacion'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $receta['id_receta'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $receta['id_receta'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>