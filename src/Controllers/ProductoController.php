<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\ProductoModel;

class ProductoController extends Controller
{
  private ProductoModel $productoModel;

  public function __construct()
  {
    $this->productoModel = new ProductoModel();
  }

  public function index(): void
  {
    Session::requireAuth();

    if ($this->isAjax()) {
      // Devolver solo la vista parcial
      $productos = $this->productoModel->getAll();
      $this->view('productos/index', ['productos' => $productos]);
    } else {
      // Devolver con layout
      $productos = $this->productoModel->getAll();
      $this->view('layouts/main', [
        'usuario' => Session::getUser(),
        'productos' => $productos
      ]);
    }
  }

  public function store(): void
  {
    Session::requireAuth();

    $data = $this->getAllInputs();
    $result = $this->productoModel->create($data);
    $this->json($result);
  }

  public function update(): void
  {
    Session::requireAuth();

    $id = (int) $this->getInput('id');
    $data = $this->getAllInputs();
    $result = $this->productoModel->update($id, $data);
    $this->json($result);
  }

  public function destroy(): void
  {
    Session::requireAuth();

    $id = (int) $this->getInput('id');
    $result = $this->productoModel->delete($id);
    $this->json($result);
  }
}
