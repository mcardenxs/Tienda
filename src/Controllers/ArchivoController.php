<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\ArchivoModel;

class ArchivoController extends Controller
{
  private ArchivoModel $archivoModel;
  private const UPLOAD_DIR = __DIR__ . '/../../public/uploads/';
  private const MAX_FILE_SIZE = 10 * 1024 * 1024;
  private const ALLOWED_EXTENSIONS = [
    'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg',
    'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'rtf',
    'zip', 'rar', '7z', 'tar', 'gz',
    'mp3', 'wav', 'ogg', 'flac',
    'mp4', 'avi', 'mkv', 'mov', 'webm'
  ];

  public function __construct()
  {
    $this->archivoModel = new ArchivoModel();
  }

  public function index(): void
  {
    if (!Session::isLoggedIn()) {
      if ($this->isAjax()) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'No autenticado']);
        return;
      }
      $this->redirect('/Tienda/public/login');
      return;
    }

    try {
      $archivos = $this->archivoModel->getAll();
    } catch (\Throwable $e) {
      error_log("Error en ArchivoModel::getAll: " . $e->getMessage());
      $archivos = [];
    }

    if ($this->isAjax()) {
      $this->view('archivos/index', ['archivos' => $archivos]);
    } else {
      $this->view('layouts/main', [
        'usuario' => Session::getUser(),
        'archivos' => $archivos
      ]);
    }
  }

  public function store(): void
  {
    Session::requireAuth();

    if (!$this->isPost()) {
      $this->json(['status' => 'error', 'message' => 'Método no permitido.']);
      return;
    }

    if (empty($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
      $this->json(['status' => 'error', 'message' => 'No se seleccionó ningún archivo o hubo un error al subir.']);
      return;
    }

    $file = $_FILES['archivo'];

    if ($file['size'] > self::MAX_FILE_SIZE) {
      $this->json(['status' => 'error', 'message' => 'El archivo excede el límite de 10 MB.']);
      return;
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
      $this->json(['status' => 'error', 'message' => 'Tipo de archivo no permitido.']);
      return;
    }

    $userId = Session::getUserId();
    $userDir = self::UPLOAD_DIR . $userId . '/';

    if (!is_dir($userDir)) {
      mkdir($userDir, 0755, true);
    }

    $tempName = bin2hex(random_bytes(16)) . '.' . $extension;
    $destination = $userDir . $tempName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
      $this->json(['status' => 'error', 'message' => 'Error al mover el archivo.']);
      return;
    }

    $data = [
      'nombre' => basename($file['name']),
      'nombre_temporal' => $tempName,
      'ruta' => '/Tienda/public/uploads/' . $userId . '/' . $tempName,
      'tipo' => $file['type'],
      'tamano' => $file['size'],
      'descripcion_corta' => $this->getInput('descripcion_corta'),
      'descripcion_larga' => $this->getInput('descripcion_larga'),
      'fk_usuario_id' => $userId
    ];

    $result = $this->archivoModel->create($data);
    $this->json($result);
  }

  public function update(): void
  {
    Session::requireAuth();

    $id = (int) $this->getInput('id');
    $data = [
      'descripcion_corta' => $this->getInput('descripcion_corta'),
      'descripcion_larga' => $this->getInput('descripcion_larga')
    ];

    $result = $this->archivoModel->update($id, $data);
    $this->json($result);
  }

  public function destroy(): void
  {
    Session::requireAuth();

    $id = (int) $this->getInput('id');
    $archivo = $this->archivoModel->findById($id);

    if (!$archivo) {
      $this->json(['status' => 'error', 'message' => 'Archivo no encontrado.']);
      return;
    }

    $userId = Session::getUserId();
    $filePath = self::UPLOAD_DIR . $userId . '/' . $archivo['nombre_temporal'];
    if (file_exists($filePath)) {
      unlink($filePath);
    }

    $result = $this->archivoModel->delete($id);
    $this->json($result);
  }

  public function download(): void
  {
    Session::requireAuth();

    $id = (int) $this->getInput('id');
    $archivo = $this->archivoModel->findById($id);

    if (!$archivo) {
      $this->json(['status' => 'error', 'message' => 'Archivo no encontrado.']);
      return;
    }

    $userId = Session::getUserId();
    $filePath = self::UPLOAD_DIR . $userId . '/' . $archivo['nombre_temporal'];

    if (!file_exists($filePath)) {
      $this->json(['status' => 'error', 'message' => 'Archivo no encontrado en el servidor.']);
      return;
    }

    $this->archivoModel->incrementDownloads($id);

    header('Content-Type: ' . $archivo['tipo']);
    header('Content-Disposition: attachment; filename="' . $archivo['nombre'] . '"');
    header('Content-Length: ' . $archivo['tamano']);
    readfile($filePath);
    exit;
  }
}