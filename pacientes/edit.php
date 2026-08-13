<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id_paciente = :id");
$stmt->execute([':id' => $id]);
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Editar Paciente</div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $paciente['id_paciente'] ?>">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= $paciente['nombre'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" name="dni" class="form-control" value="<?= $paciente['dni'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $paciente['email'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="<?= $paciente['telefono'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" value="<?= $paciente['fecha_nacimiento'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="<?= $paciente['direccion'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Razón de Consulta</label>
                <textarea name="razon_consulta" class="form-control" rows="2" required><?= $paciente['razon_consulta'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Alergias</label>
                <textarea name="alergias" class="form-control" rows="3"><?= $paciente['alergias'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipo de Sangre</label>
                <select name="tipo_sangre" class="form-control">
                    <option value="">Selecciona tipo de sangre</option>
                    <option value="O+" <?php if ($paciente['tipo_sangre'] == 'O+') echo 'selected'; ?>>O+</option>
                    <option value="O-" <?php if ($paciente['tipo_sangre'] == 'O-') echo 'selected'; ?>>O-</option>
                    <option value="A+" <?php if ($paciente['tipo_sangre'] == 'A+') echo 'selected'; ?>>A+</option>
                    <option value="A-" <?php if ($paciente['tipo_sangre'] == 'A-') echo 'selected'; ?>>A-</option>
                    <option value="B+" <?php if ($paciente['tipo_sangre'] == 'B+') echo 'selected'; ?>>B+</option>
                    <option value="B-" <?php if ($paciente['tipo_sangre'] == 'B-') echo 'selected'; ?>>B-</option>
                    <option value="AB+" <?php if ($paciente['tipo_sangre'] == 'AB+') echo 'selected'; ?>>AB+</option>
                    <option value="AB-" <?php if ($paciente['tipo_sangre'] == 'AB-') echo 'selected'; ?>>AB-</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>