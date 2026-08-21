<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

// Obtener consultas y medicamentos
$stmtConsultas = $pdo->query("SELECT c.id_consulta, p.nombre as paciente, m.nombre as medico 
                               FROM consultas c
                               JOIN pacientes p ON c.id_paciente = p.id_paciente
                               JOIN medicos m ON c.id_medico = m.id_medico
                               ORDER BY c.fecha_hora DESC");
$consultas = $stmtConsultas->fetchAll(PDO::FETCH_ASSOC);

$stmtMedicamentos = $pdo->query("SELECT id_medicamento, nombre FROM medicamentos ORDER BY nombre");
$medicamentos = $stmtMedicamentos->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Crear Receta</div>
    <div class="card-body">
        <form action="store.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Consulta</label>
                <select name="id_consulta" class="form-control" required>
                    <option value="">Selecciona una consulta</option>
                    <?php foreach ($consultas as $consulta): ?>
                    <option value="<?= $consulta['id_consulta'] ?>">
                        Consulta #<?= $consulta['id_consulta'] ?> - <?= $consulta['paciente'] ?> (Dr. <?= $consulta['medico'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Medicamento</label>
                <select name="id_medicamento" class="form-control" required>
                    <option value="">Selecciona un medicamento</option>
                    <?php foreach ($medicamentos as $medicamento): ?>
                    <option value="<?= $medicamento['id_medicamento'] ?>"><?= $medicamento['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Dosis</label>
                <input type="text" name="dosis" class="form-control" placeholder="ej: 1 tableta cada 8 horas" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Duración</label>
                <input type="text" name="duracion" class="form-control" placeholder="ej: 7 días" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Indicaciones</label>
                <textarea name="indicaciones" class="form-control" rows="3" placeholder="ej: Tomar con alimentos, no mezclar con alcohol"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>