<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\UsuarioModel;

class AuthController extends Controller
{
  private UsuarioModel $usuarioModel;

  public function __construct()
  {
    $this->usuarioModel = new UsuarioModel();
  }

  public function login(): void
  {
    if (Session::isLoggedIn()) {
      $this->redirect('/Tienda/public/');
    }

    if ($this->isPost()) {
      $username = trim($this->getInput('username', ''));
      $password = $this->getInput('password', '');

      if ($username === '' || $password === '') {
        $this->view('auth/login', ['error' => 'Debes capturar usuario y contraseña.']);
        return;
      }

      $usuario = $this->usuarioModel->findByUsername($username);

      if ($usuario && $this->usuarioModel->verifyPassword($password, $usuario['password'])) {
        Session::set('usuario_id', $usuario['id']);
        Session::set('usuario', $usuario['username']);
        Session::set('rol', $usuario['rol']);
        $this->redirect('/Tienda/public/');
      } else {
        $this->view('auth/login', ['error' => 'Usuario o contraseña incorrectos.']);
      }
    } else {
      $this->view('auth/login', ['error' => '']);
    }
  }

  public function logout(): void
  {
    Session::destroy();
    $this->redirect('/Tienda/public/');
  }
}
