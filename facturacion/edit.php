<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM facturacion WHERE id_factura = :id");
$stmt->execute([':id' => $id]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener consultas y pacientes
$stmtConsultas = $pdo->query("SELECT c.id_consulta, p.nombre as paciente, m.nombre as medico 
                               FROM consultas c
                               JOIN pacientes p ON c.id_paciente = p.id_paciente
                               JOIN medicos m ON c.id_medico = m.id_medico
                               ORDER BY c.fecha_hora DESC");
$consultas = $stmtConsultas->fetchAll(PDO::FETCH_ASSOC);

$stmtPacientes = $pdo->query("SELECT id_paciente, nombre FROM pacientes ORDER BY nombre");
$pacientes = $stmtPacientes->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">Editar Factura</div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $factura['id_factura'] ?>">
            <div class="mb-3">
                <label class="form-label">Consulta</label>
                <select name="id_consulta" class="form-control" required>
                    <?php foreach ($consultas as $consulta): ?>
                    <option value="<?= $consulta['id_consulta'] ?>" <?php if ($consulta['id_consulta'] == $factura['id_consulta']) echo 'selected'; ?>>
                        Consulta #<?= $consulta['id_consulta'] ?> - <?= $consulta['paciente'] ?> (Dr. <?= $consulta['medico'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Paciente</label>
                <select name="id_paciente" class="form-control" required>
                    <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id_paciente'] ?>" <?php if ($paciente['id_paciente'] == $factura['id_paciente']) echo 'selected'; ?>>
                        <?= $paciente['nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Monto</label>
                <input type="number" name="monto" class="form-control" step="0.01" value="<?= $factura['monto'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Método de Pago</label>
                <select name="metodo_pago" class="form-control">
                    <option value="efectivo" <?php if ($factura['metodo_pago'] == 'efectivo') echo 'selected'; ?>>Efectivo</option>
                    <option value="tarjeta" <?php if ($factura['metodo_pago'] == 'tarjeta') echo 'selected'; ?>>Tarjeta</option>
                    <option value="transferencia" <?php if ($factura['metodo_pago'] == 'transferencia') echo 'selected'; ?>>Transferencia</option>
                    <option value="cheque" <?php if ($factura['metodo_pago'] == 'cheque') echo 'selected'; ?>>Cheque</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-control">
                    <option value="pendiente" <?php if ($factura['estado'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                    <option value="pagada" <?php if ($factura['estado'] == 'pagada') echo 'selected'; ?>>Pagada</option>
                    <option value="cancelada" <?php if ($factura['estado'] == 'cancelada') echo 'selected'; ?>>Cancelada</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de Pago</label>
                <input type="datetime-local" name="fecha_pago" class="form-control" value="<?php if ($factura['fecha_pago']) echo str_replace(' ', 'T', $factura['fecha_pago']); ?>">
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>