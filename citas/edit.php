<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM citas WHERE id_cita = :id");
$stmt->execute([':id' => $id]);
$cita = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener pacientes y médicos
$stmtPacientes = $pdo->query("SELECT id_paciente, nombre FROM pacientes ORDER BY nombre");
$pacientes = $stmtPacientes->fetchAll(PDO::FETCH_ASSOC);

$stmtMedicos = $pdo->query("SELECT id_medico, nombre FROM medicos ORDER BY nombre");
$medicos = $stmtMedicos->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Editar Cita</div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $cita['id_cita'] ?>">
            <div class="mb-3">
                <label class="form-label">Paciente</label>
                <select name="id_paciente" class="form-control" required>
                    <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id_paciente'] ?>" <?php if ($paciente['id_paciente'] == $cita['id_paciente']) echo 'selected'; ?>>
                        <?= $paciente['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Médico</label>
                <select name="id_medico" class="form-control" required>
                    <?php foreach ($medicos as $medico): ?>
                    <option value="<?= $medico['id_medico'] ?>" <?php if ($medico['id_medico'] == $cita['id_medico']) echo 'selected'; ?>>
                        <?= $medico['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha y Hora</label>
                <input type="datetime-local" name="fecha_hora" class="form-control" value="<?= str_replace(' ', 'T', $cita['fecha_hora']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Motivo</label>
                <textarea name="motivo" class="form-control" rows="3" required><?= $cita['motivo'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-control">
                    <option value="pendiente" <?php if ($cita['estado'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                    <option value="confirmada" <?php if ($cita['estado'] == 'confirmada') echo 'selected'; ?>>Confirmada</option>
                    <option value="cancelada" <?php if ($cita['estado'] == 'cancelada') echo 'selected'; ?>>Cancelada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>