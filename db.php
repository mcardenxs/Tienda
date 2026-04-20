<?php
require_once 'vendor/autoload.php';

// Configuración de la base de datos
// XAMPP suele usar el puerto 3306 por defecto, pero si lo cambiaste a 3307 cámbialo aquí.
$host = 'localhost';
// XAMPP usa 3306 por defecto. Cambia a 3307 solo si lo modificaste en la config de MySQL.
$port = '3306';
$dbname = 'tienda';
$user = 'root';
$password = 'television07';

// DSN para MeekroDB
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $db = new MeekroDB($dsn, $user, $password);
} catch (Throwable $e) {
    die("Error de conexión: " . $e->getMessage());
}
