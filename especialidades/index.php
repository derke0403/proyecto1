<?php
require_once '../config/database.php';
require_once '../includes/header.php';

$stmt = $pdo->query("SELECT * FROM especialidades");
$especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="create.php" class="btn btn-primary">Nueva Especialidad</a>
            </div>
            <div class="col-md-6">
                <div class="float-end">Listado de Especialidades</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($especialidades as $especialidad): ?>
                <tr>
                    <td><?= $especialidad['id_especialidad'] ?></td>
                    <td><?= $especialidad['nombre'] ?></td>
                    <td><?= $especialidad['descripcion'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $especialidad['id_especialidad'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= $especialidad['id_especialidad'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>