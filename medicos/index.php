<?php
require_once '../config/database.php';
require_once '../includes/header.php';

$stmt = $pdo->query("SELECT m.id_medico, m.nombre, m.email, m.telefono, m.licencia_profesional, e.nombre as especialidad 
                     FROM medicos m 
                     JOIN especialidades e ON m.id_especialidad = e.id_especialidad");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="create.php" class="btn btn-primary">Nuevo Médico</a>
            </div>
            <div class="col-md-6">
                <div class="float-end">Listado de Médicos</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Licencia</th>
                    <th>Especialidad</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicos as $medico): ?>
                <tr>
                    <td><?= $medico['id_medico'] ?></td>
                    <td><?= $medico['nombre'] ?></td>
                    <td><?= $medico['email'] ?></td>
                    <td><?= $medico['telefono'] ?></td>
                    <td><?= $medico['licencia_profesional'] ?></td>
                    <td><?= $medico['especialidad'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $medico['id_medico'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= $medico['id_medico'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>