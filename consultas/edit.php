<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM consultas WHERE id_consulta = :id");
$stmt->execute([':id' => $id]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener pacientes y médicos
$stmtPacientes = $pdo->query("SELECT id_paciente, nombre FROM pacientes ORDER BY nombre");
$pacientes = $stmtPacientes->fetchAll(PDO::FETCH_ASSOC);

$stmtMedicos = $pdo->query("SELECT id_medico, nombre FROM medicos ORDER BY nombre");
$medicos = $stmtMedicos->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Editar Consulta</div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $consulta['id_consulta'] ?>">
            <div class="mb-3">
                <label class="form-label">Paciente</label>
                <select name="id_paciente" class="form-control" required>
                    <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id_paciente'] ?>" <?php if ($paciente['id_paciente'] == $consulta['id_paciente']) echo 'selected'; ?>>
                        <?= $paciente['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Médico</label>
                <select name="id_medico" class="form-control" required>
                    <?php foreach ($medicos as $medico): ?>
                    <option value="<?= $medico['id_medico'] ?>" <?php if ($medico['id_medico'] == $consulta['id_medico']) echo 'selected'; ?>>
                        <?= $medico['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Síntomas</label>
                <textarea name="sintomas" class="form-control" rows="3" required><?= $consulta['sintomas'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Diagnóstico</label>
                <textarea name="diagnostico" class="form-control" rows="3" required><?= $consulta['diagnostico'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Notas del Médico</label>
                <textarea name="notas_medico" class="form-control" rows="3"><?= $consulta['notas_medico'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-control">
                    <option value="completada" <?php if ($consulta['estado'] == 'completada') echo 'selected'; ?>>Completada</option>
                    <option value="pendiente" <?php if ($consulta['estado'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>