<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';
?>

<div class="card">
    <div class="card-header">Crear Medicamento</div>
    <div class="card-body">
        <form action="store.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Principio Activo</label>
                <input type="text" name="principio_activo" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" step="0.01">
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha Vencimiento</label>
                <input type="date" name="fecha_vencimiento" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>