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

$stmt = $pdo->query("SELECT * FROM pacientes");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="create.php" class="btn btn-primary">Nuevo Paciente</a>
            </div>
            <div class="col-md-6">
                <div class="float-end">Listado de Pacientes</div>
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
                        <th>DNI</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Razón de consulta</th>
                        <th>Alergias</th>
                        <th>Tipo de sangre</th>
                        <th>Fecha de registro</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientes as $paciente): ?>
                    <tr>
                        <td><?= $paciente['id_paciente'] ?></td>
                        <td><?= $paciente['nombre'] ?></td>
                        <td><?= $paciente['dni'] ?></td>
                        <td><?= $paciente['email'] ?></td>
                        <td><?= $paciente['telefono'] ?></td>
                        <td><?= $paciente['razon_consulta'] ?></td>
                        <td><?= $paciente['alergias'] ?></td>
                        <td><?= $paciente['tipo_sangre'] ?></td>
                        <td><?= $paciente['fecha_registro'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $paciente['id_paciente'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $paciente['id_paciente'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>