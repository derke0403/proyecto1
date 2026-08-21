<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM medicos WHERE id_medico = :id");
$stmt->execute([':id' => $id]);
$medico = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM especialidades");
$especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Editar Médico</div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $medico['id_medico'] ?>">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= $medico['nombre'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $medico['email'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="<?= $medico['telefono'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Licencia Profesional</label>
                <input type="text" name="licencia_profesional" class="form-control" value="<?= $medico['licencia_profesional'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Especialidad</label>
                <select name="id_especialidad" class="form-control" required>
                    <?php foreach ($especialidades as $especialidad): ?>
                    <option value="<?= $especialidad['id_especialidad'] ?>" <?php if ($especialidad['id_especialidad'] == $medico['id_especialidad']) echo 'selected'; ?>>
                        <?= $especialidad['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>