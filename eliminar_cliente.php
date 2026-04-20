<?php
require_once 'auth.php';
require_once 'db.php';

$id = isset($_POST['id_cliente']) ? (int) $_POST['id_cliente'] : 0;

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ID de cliente no válido.']);
    exit;
}

try {
    $db->delete('clientes', 'id_cliente=%i', $id);
    echo json_encode(['status' => 'ok', 'message' => 'Cliente eliminado correctamente.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()]);
}
