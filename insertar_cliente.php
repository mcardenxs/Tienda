<?php
require_once 'auth.php';
require_once 'db.php';

$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$rfc = $_POST['rfc'];

if (empty($nombre) || empty($apellido_paterno) || empty($rfc)) {
    echo json_encode(['status' => 'error', 'message' => 'Los campos Nombre, Apellido Paterno y RFC son obligatorios.']);
    exit;
}

try {
    $db->insert('clientes', [
        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'rfc' => $rfc
    ]);
    echo json_encode(['status' => 'ok', 'message' => 'Cliente registrado correctamente.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al registrar: ' . $e->getMessage()]);
}
