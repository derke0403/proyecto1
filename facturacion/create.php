<?php
session_start();
require_once '../config/database.php';
require_once '../includes/header.php';

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
    <div class="card-header">Crear Factura</div>
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
                <label class="form-label">Paciente</label>
                <select name="id_paciente" class="form-control" required>
                    <option value="">Selecciona un paciente</option>
                    <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id_paciente'] ?>"><?= $paciente['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Monto</label>
                <input type="number" name="monto" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Método de Pago</label>
                <select name="metodo_pago" class="form-control">
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="cheque">Cheque</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>