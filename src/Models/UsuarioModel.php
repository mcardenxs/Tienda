<?php

namespace App\Models;

use App\Config\Database;

class UsuarioModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getConnection();
  }

  public function findByUsername(string $username): ?array
  {
    $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $result = $stmt->fetch();
    return $result ?: null;
  }

  public function verifyPassword(string $password, string $hash): bool
  {
    return password_verify($password, $hash);
  }

  public function createUser(string $username, string $password, string $rol = 'usuario'): bool
  {
    try {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $this->db->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)");
      $stmt->execute([$username, $hashedPassword, $rol]);
      return true;
    } catch (\Throwable $e) {
      error_log($e->getMessage());
      return false;
    }
  }

  public function updatePassword(int $id, string $newPassword): bool
  {
    try {
      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $stmt = $this->db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
      $stmt->execute([$hashedPassword, $id]);
      return true;
    } catch (\Throwable $e) {
      error_log($e->getMessage());
      return false;
    }
  }
}
