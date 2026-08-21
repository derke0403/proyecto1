<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM recetas WHERE id_receta = :id");
$stmt->execute([':id' => $id]);
$receta = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <div class="card-header">Editar Receta</div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $receta['id_receta'] ?>">
            <div class="mb-3">
                <label class="form-label">Consulta</label>
                <select name="id_consulta" class="form-control" required>
                    <?php foreach ($consultas as $consulta): ?>
                    <option value="<?= $consulta['id_consulta'] ?>" <?php if ($consulta['id_consulta'] == $receta['id_consulta']) echo 'selected'; ?>>
                        Consulta #<?= $consulta['id_consulta'] ?> - <?= $consulta['paciente'] ?> (Dr. <?= $consulta['medico'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Medicamento</label>
                <select name="id_medicamento" class="form-control" required>
                    <?php foreach ($medicamentos as $medicamento): ?>
                    <option value="<?= $medicamento['id_medicamento'] ?>" <?php if ($medicamento['id_medicamento'] == $receta['id_medicamento']) echo 'selected'; ?>>
                        <?= $medicamento['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Dosis</label>
                <input type="text" name="dosis" class="form-control" value="<?= $receta['dosis'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Duración</label>
                <input type="text" name="duracion" class="form-control" value="<?= $receta['duracion'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Indicaciones</label>
                <textarea name="indicaciones" class="form-control" rows="3"><?= $receta['indicaciones'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>