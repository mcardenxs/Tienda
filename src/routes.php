<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ProductoController;
use App\Controllers\ClienteController;
use App\Controllers\ArchivoController;

function setupRoutes($router)
{
  // Rutas de autenticación
  $router->get('/login', [AuthController::class, 'login']);
  $router->post('/login', [AuthController::class, 'login']);
  $router->post('/logout', [AuthController::class, 'logout']);
  $router->get('/logout', [AuthController::class, 'logout']);

  // Dashboard
  $router->get('/', [DashboardController::class, 'index']);
  $router->get('/dashboard', [DashboardController::class, 'index']);

  // Productos
  $router->get('/productos', [ProductoController::class, 'index']);
  $router->post('/productos/guardar', [ProductoController::class, 'store']);
  $router->post('/productos/actualizar', [ProductoController::class, 'update']);
  $router->post('/productos/eliminar', [ProductoController::class, 'destroy']);

  // Clientes
  $router->get('/clientes', [ClienteController::class, 'index']);
  $router->post('/clientes/guardar', [ClienteController::class, 'store']);
  $router->post('/clientes/actualizar', [ClienteController::class, 'update']);
  $router->post('/clientes/eliminar', [ClienteController::class, 'destroy']);

  // Archivos
  $router->get('/archivos', [ArchivoController::class, 'index']);
  $router->post('/archivos/guardar', [ArchivoController::class, 'store']);
  $router->post('/archivos/actualizar', [ArchivoController::class, 'update']);
  $router->post('/archivos/eliminar', [ArchivoController::class, 'destroy']);
  $router->get('/archivos/descargar', [ArchivoController::class, 'download']);
}
