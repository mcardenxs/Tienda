<?php
require_once 'auth.php';
require_once 'db.php';

$id = isset($_POST['id_cliente']) ? (int) $_POST['id_cliente'] : 0;
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$rfc = $_POST['rfc'];

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ID de cliente no válido.']);
    exit;
}

if (empty($nombre) || empty($apellido_paterno) || empty($rfc)) {
    echo json_encode(['status' => 'error', 'message' => 'Los campos Nombre, Apellido Paterno y RFC son obligatorios.']);
    exit;
}

try {
    $db->update('clientes', [
        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'rfc' => $rfc
    ], 'id_cliente=%i', $id);
    echo json_encode(['status' => 'ok', 'message' => 'Cliente actualizado correctamente.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()]);
}
