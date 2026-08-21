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

$stmt = $pdo->query("SELECT c.id_cita, c.fecha_hora, c.motivo, c.estado, c.fecha_creacion, p.nombre as paciente, m.nombre as medico
                     FROM citas c
                     JOIN pacientes p ON c.id_paciente = p.id_paciente
                     JOIN medicos m ON c.id_medico = m.id_medico
                     ORDER BY c.fecha_hora DESC");
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="create.php" class="btn btn-primary">Nueva Cita</a>
            </div>
            <div class="col-md-6">
                <div class="float-end">Listado de Citas</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Fecha y Hora</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($citas as $cita): ?>
                    <tr>
                        <td><?= $cita['id_cita'] ?></td>
                        <td><?= $cita['paciente'] ?></td>
                        <td><?= $cita['medico'] ?></td>
                        <td><?= $cita['fecha_hora'] ?></td>
                        <td><?= $cita['motivo'] ?></td>
                        <td><?= $cita['estado'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $cita['id_cita'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $cita['id_cita'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>