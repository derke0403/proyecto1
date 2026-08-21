<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM medicamentos WHERE id_medicamento = :id");
$stmt->execute([':id' => $id]);
$medicamento = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Editar Medicamento</div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $medicamento['id_medicamento'] ?>">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= $medicamento['nombre'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Principio Activo</label>
                <input type="text" name="principio_activo" class="form-control" value="<?= $medicamento['principio_activo'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" step="0.01" value="<?= $medicamento['precio'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="<?= $medicamento['stock'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha Vencimiento</label>
                <input type="date" name="fecha_vencimiento" class="form-control" value="<?= $medicamento['fecha_vencimiento'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"><?= $medicamento['descripcion'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>