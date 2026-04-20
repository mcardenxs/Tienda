<?php
require_once 'auth.php';
require_once 'db.php';

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];

if (empty($nombre) || $cantidad === '' || $precio === '' || empty($categoria)) {
    echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

if ($cantidad < 0 || $precio < 0) {
    echo json_encode(['status' => 'error', 'message' => 'Cantidad y Precio deben ser mayores o iguales a 0.']);
    exit;
}

try {
    $db->insert('productos', [
        'nombre' => $nombre,
        'cantidad' => (int) $cantidad,
        'precio' => (float) $precio,
        'categoria' => $categoria
    ]);
    echo json_encode(['status' => 'ok', 'message' => 'Producto registrado correctamente.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al registrar: ' . $e->getMessage()]);
}
