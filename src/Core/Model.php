<?php

namespace App\Core;

use App\Config\Database;

abstract class Model
{
  protected $db;
  protected string $table;

  public function __construct()
  {
    $this->db = Database::getConnection();
  }

  public function all(): array
  {
    return $this->db->query("SELECT * FROM {$this->table}")->fetchAll();
  }

  public function find(int $id): ?array
  {
    $result = $this->db->query("SELECT * FROM {$this->table} WHERE id = %i", $id)->fetch();
    return $result ?: null;
  }

  public function create(array $data): array
  {
    try {
      $this->db->insert($this->table, $data);
      return ['status' => 'ok', 'message' => 'Registro creado correctamente.'];
    } catch (\Throwable $e) {
      error_log($e->getMessage());
      return ['status' => 'error', 'message' => 'Error al crear: ' . $e->getMessage()];
    }
  }

  public function update(int $id, array $data): array
  {
    try {
      $this->db->update($this->table, $data, 'id=%i', $id);
      return ['status' => 'ok', 'message' => 'Registro actualizado correctamente.'];
    } catch (\Throwable $e) {
      error_log($e->getMessage());
      return ['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()];
    }
  }

  public function delete(int $id): array
  {
    try {
      $this->db->delete($this->table, 'id=%i', $id);
      return ['status' => 'ok', 'message' => 'Registro eliminado correctamente.'];
    } catch (\Throwable $e) {
      error_log($e->getMessage());
      return ['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()];
    }
  }
}
