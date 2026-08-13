<?php
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
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= $medico['nombre'] ?>" required>
            </div>
            <div class="mb-3">