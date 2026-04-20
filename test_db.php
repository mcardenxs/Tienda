<?php
require_once 'db.php';

try {
    $db->query("SELECT 1");
    echo "Conexión exitosa a la base de datos.";
} catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage();
    echo "\n\nIntenta cambiar el puerto en db.php (de 3307 a 3306 o viceversa).";
}
?>
