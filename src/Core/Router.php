<?php

namespace App\Core;

class Router
{
  protected array $routes = [];

  public function get(string $path, array $action): self
  {
    $this->routes['GET'][$this->normalizePath($path)] = $action;
    return $this;
  }

  public function post(string $path, array $action): self
  {
    $this->routes['POST'][$this->normalizePath($path)] = $action;
    return $this;
  }

  public function dispatch(string $method, string $uri): void
  {
    $method = strtoupper($method);
    $uri = $this->normalizePath($uri);

    error_log("Dispatch: $method $uri");
    error_log("Available routes: " . json_encode(array_keys($this->routes[$method] ?? [])));

    if (isset($this->routes[$method][$uri])) {
      [$controller, $action] = $this->routes[$method][$uri];
      error_log("Matched route: $controller::$action");
      $this->callController($controller, $action);
    } else {
      http_response_code(404);
      echo "Página no encontrada: $uri";
    }
  }

  private function normalizePath(string $path): string
  {
    $path = trim($path, '/');
    return $path === '' ? '/' : '/' . $path;
  }

  private function callController(string $controller, string $action): void
  {
    if (class_exists($controller)) {
      $controllerInstance = new $controller();
      if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
      } else {
        http_response_code(404);
        echo "Método no encontrado: $action";
      }
    } else {
      http_response_code(404);
      echo "Controlador no encontrado: $controller";
    }
  }

  public function getRoutes(): array
  {
    return $this->routes;
  }
}
