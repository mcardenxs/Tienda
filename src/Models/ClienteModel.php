<?php

namespace App\Models;

use App\Config\Database;

class ClienteModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getConnection();
  }

  public function getAll(): array
  {
    $stmt = $this->db->query("SELECT * FROM clientes ORDER BY 1 DESC");
    return $stmt->fetchAll();
  }

  public function findById(int $id): ?array
  {
    $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result ?: null;
  }

  public function create(array $data): array
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO clientes (nombre, telefono, email, direccion) VALUES (?, ?, ?, ?)");
      $stmt->execute([
        $data['nombre'],
        $data['telefono'] ?? '',
        $data['email'] ?? '',
        $data['direccion'] ?? ''
      ]);
      return ['status' => 'ok', 'message' => 'Cliente registrado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al registrar: ' . $e->getMessage()];
    }
  }

  public function update(int $id, array $data): array
  {
    try {
      $stmt = $this->db->prepare("UPDATE clientes SET nombre = ?, telefono = ?, email = ?, direccion = ? WHERE id_cliente = ?");
      $stmt->execute([
        $data['nombre'],
        $data['telefono'] ?? '',
        $data['email'] ?? '',
        $data['direccion'] ?? '',
        $id
      ]);
      return ['status' => 'ok', 'message' => 'Cliente actualizado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()];
    }
  }

  public function delete(int $id): array
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM clientes WHERE id_cliente = ?");
      $stmt->execute([$id]);
      return ['status' => 'ok', 'message' => 'Cliente eliminado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()];
    }
  }
}
