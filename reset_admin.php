<?php
require_once 'db.php';

try {
    // 1. Crear tabla si no existe
    $db->query("CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        rol ENUM('admin') DEFAULT 'admin',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. Limpiar usuario admin previo para evitar duplicados
    $db->query("DELETE FROM usuarios WHERE username = 'admin'");

    // 3. Insertar nuevo admin (usuario: admin, contraseña: admin)
    $passwordHash = password_hash('admin', PASSWORD_DEFAULT);
    
    $db->insert('usuarios', [
        'username' => 'admin',
        'password' => $passwordHash,
        'rol' => 'admin'
    ]);

    echo "<h3>¡Configuración Exitosa!</h3>";
    echo "<p>Se ha creado/restaurado el usuario administrador.</p>";
    echo "<ul>";
    echo "<li><strong>Usuario:</strong> admin</li>";
    echo "<li><strong>Contraseña:</strong> admin</li>";
    echo "</ul>";
    echo "<p><a href='login.php'>Ir al Login</a></p>";

} catch (Throwable $e) {
    echo "<h3>Error durante la configuración</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Verifica que la base de datos 'tienda' exista en tu PHPMyAdmin y que el puerto en <strong>db.php</strong> sea el correcto.</p>";
}
?>
