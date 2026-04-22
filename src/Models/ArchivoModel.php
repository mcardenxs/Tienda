<?php

namespace App\Models;

use App\Config\Database;

class ArchivoModel
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getConnection();
  }

  public function getAll(): array
  {
    $stmt = $this->db->query("SELECT * FROM archivos ORDER BY created_at DESC");
    return $stmt->fetchAll();
  }

  public function getByUserId(int $userId): array
  {
    $stmt = $this->db->prepare("SELECT * FROM archivos WHERE fk_usuario_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
  }

  public function findById(int $id): ?array
  {
    $stmt = $this->db->prepare("SELECT * FROM archivos WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result ?: null;
  }

  public function create(array $data): array
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO archivos (nombre, nombre_temporal, ruta, tipo, tamano, descripcion_corta, descripcion_larga, fk_usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([
        $data['nombre'],
        $data['nombre_temporal'],
        $data['ruta'],
        $data['tipo'],
        (int) $data['tamano'],
        $data['descripcion_corta'] ?? null,
        $data['descripcion_larga'] ?? null,
        (int) $data['fk_usuario_id']
      ]);
      return ['status' => 'ok', 'message' => 'Archivo subido correctamente.', 'id' => $this->db->lastInsertId()];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al registrar: ' . $e->getMessage()];
    }
  }

  public function update(int $id, array $data): array
  {
    try {
      $stmt = $this->db->prepare("UPDATE archivos SET descripcion_corta = ?, descripcion_larga = ? WHERE id = ?");
      $stmt->execute([
        $data['descripcion_corta'] ?? null,
        $data['descripcion_larga'] ?? null,
        $id
      ]);
      return ['status' => 'ok', 'message' => 'Archivo actualizado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()];
    }
  }

  public function delete(int $id): array
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM archivos WHERE id = ?");
      $stmt->execute([$id]);
      return ['status' => 'ok', 'message' => 'Archivo eliminado correctamente.'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()];
    }
  }

  public function incrementDownloads(int $id): array
  {
    try {
      $stmt = $this->db->prepare("UPDATE archivos SET descargas = descargas + 1 WHERE id = ?");
      $stmt->execute([$id]);
      return ['status' => 'ok'];
    } catch (\Throwable $e) {
      return ['status' => 'error', 'message' => $e->getMessage()];
    }
  }

  public function countAll(): int
  {
    $stmt = $this->db->query("SELECT COUNT(*) FROM archivos");
    return (int) $stmt->fetchColumn();
  }
}