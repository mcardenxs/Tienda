<?php
require_once 'auth.php';
require_once 'db.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ID de producto no válido.']);
    exit;
}

if (empty($nombre) || $cantidad === '' || $precio === '' || empty($categoria)) {
    echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

if ($cantidad < 0 || $precio < 0) {
    echo json_encode(['status' => 'error', 'message' => 'Cantidad y Precio deben ser mayores o iguales a 0.']);
    exit;
}

try {
    $db->update('productos', [
        'nombre' => $nombre,
        'cantidad' => (int) $cantidad,
        'precio' => (float) $precio,
        'categoria' => $categoria
    ], 'id=%i', $id);
    echo json_encode(['status' => 'ok', 'message' => 'Producto actualizado correctamente.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()]);
}
