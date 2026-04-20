<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Bootstrap
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/routes.php';

// Get request info
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove /Tienda/public from URI if present
$basePath = '/Tienda/public';
if (strpos($uri, $basePath) === 0) {
  $uri = substr($uri, strlen($basePath));
}
if ($uri === '') {
  $uri = '/';
}

// Initialize router
$router = new App\Core\Router();
setupRoutes($router);

// Dispatch
$router->dispatch($method, $uri);
