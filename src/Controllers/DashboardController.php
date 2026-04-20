<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\ProductoModel;
use App\Models\ClienteModel;

class DashboardController extends Controller
{
  public function index(): void
  {
    Session::requireAuth();

    $productoModel = new ProductoModel();
    $clienteModel = new ClienteModel();

    $total_productos = count($productoModel->getAll());
    $total_clientes = count($clienteModel->getAll());

    // Soporte para AJAX - devuelve solo contenido
    if ($this->isAjax()) {
      $this->view('dashboard/index', [
        'total_productos' => $total_productos,
        'total_clientes' => $total_clientes
      ]);
    } else {
      $this->view('layouts/main', [
        'usuario' => Session::getUser(),
        'total_productos' => $total_productos,
        'total_clientes' => $total_clientes
      ]);
    }
  }
}
