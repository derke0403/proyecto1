<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

// Obtener pacientes y médicos
$stmtPacientes = $pdo->query("SELECT id_paciente, nombre FROM pacientes ORDER BY nombre");
$pacientes = $stmtPacientes->fetchAll(PDO::FETCH_ASSOC);

$stmtMedicos = $pdo->query("SELECT id_medico, nombre FROM medicos ORDER BY nombre");
$medicos = $stmtMedicos->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Crear Consulta</div>
    <div class="card-body">
        <form action="store.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Paciente</label>
                <select name="id_paciente" class="form-control" required>
                    <option value="">Selecciona un paciente</option>
                    <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id_paciente'] ?>"><?= $paciente['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Médico</label>
                <select name="id_medico" class="form-control" required>
                    <option value="">Selecciona un médico</option>
                    <?php foreach ($medicos as $medico): ?>
                    <option value="<?= $medico['id_medico'] ?>"><?= $medico['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Síntomas</label>
                <textarea name="sintomas" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Diagnóstico</label>
                <textarea name="diagnostico" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Notas del Médico</label>
                <textarea name="notas_medico" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>