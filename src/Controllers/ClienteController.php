<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\ClienteModel;

class ClienteController extends Controller
{
  private ClienteModel $clienteModel;

  public function __construct()
  {
    $this->clienteModel = new ClienteModel();
  }

  public function index(): void
  {
    Session::requireAuth();

    if ($this->isAjax()) {
      // Devolver solo la vista parcial
      $clientes = $this->clienteModel->getAll();
      $this->view('clientes/index', ['clientes' => $clientes]);
    } else {
      // Devolver con layout
      $clientes = $this->clienteModel->getAll();
      $this->view('layouts/main', [
        'usuario' => Session::getUser(),
        'clientes' => $clientes
      ]);
    }
  }

  public function store(): void
  {
    Session::requireAuth();

    $data = $this->getAllInputs();
    $result = $this->clienteModel->create($data);
    $this->json($result);
  }

  public function update(): void
  {
    Session::requireAuth();

    $id = (int) $this->getInput('id_cliente');
    $data = $this->getAllInputs();
    $result = $this->clienteModel->update($id, $data);
    $this->json($result);
  }

  public function destroy(): void
  {
    Session::requireAuth();

    $id = (int) $this->getInput('id_cliente');
    $result = $this->clienteModel->delete($id);
    $this->json($result);
  }
}
