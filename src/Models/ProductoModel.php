<?php

namespace App\Models;

use App\Config\Database;

class ProductoModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getConnection();
  }

  public function getAll(): array
  {
    $stmt = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
    return $stmt->fetchAll();
  }

  public function findById(int $id): ?array
  {
    $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result ?: null;
  }

  public function create(array $data): array
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO productos (nombre, cantidad, precio, categoria) VALUES (?, ?, ?, ?)");
      $stmt->execute([
        $data['nombre'],
        (int) $data['cantidad'],
        (float) $data['precio'],
        $data['categoria']
      ]);
      return ['status' => 'ok', 'message' => 'Producto registrado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al registrar: ' . $e->getMessage()];
    }
  }

  public function update(int $id, array $data): array
  {
    try {
      $stmt = $this->db->prepare("UPDATE productos SET nombre = ?, cantidad = ?, precio = ?, categoria = ? WHERE id = ?");
      $stmt->execute([
        $data['nombre'],
        (int) $data['cantidad'],
        (float) $data['precio'],
        $data['categoria'],
        $id
      ]);
      return ['status' => 'ok', 'message' => 'Producto actualizado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()];
    }
  }

  public function delete(int $id): array
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM productos WHERE id = ?");
      $stmt->execute([$id]);
      return ['status' => 'ok', 'message' => 'Producto eliminado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()];
    }
  }
}
