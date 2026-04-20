<?php
require_once 'auth.php';
require_once 'db.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ID de producto no válido.']);
    exit;
}

try {
    $db->delete('productos', 'id=%i', $id);
    echo json_encode(['status' => 'ok', 'message' => 'Producto eliminado correctamente.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()]);
}
