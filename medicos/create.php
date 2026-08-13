<?php
require_once '../config/database.php';
require_once '../includes/header.php';

$stmt = $pdo->query("SELECT * FROM especialidades");
$especialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Crear Médico</div>
    <div class="card-body">
        <form action="store.php" method="POST">
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control">
            </div>
            <div class="mb-3">
                <label>Licencia Profesional</label>
                <input type="text" name="licencia_profesional" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Especialidad</label>
                <select name="id_especialidad" class="form-control" required>
                    <option value="">Selecciona una especialidad</option>
                    <?php foreach ($especialidades as $especialidad): ?>
                    <option value="<?= $especialidad['id_especialidad'] ?>"><?= $especialidad['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>