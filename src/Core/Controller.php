<?php

namespace App\Core;

abstract class Controller
{
  protected function view(string $view, array $data = []): void
  {
    extract($data);

    $viewFile = dirname(__DIR__) . '/Views/' . str_replace('.', '/', $view) . '.php';

    if (file_exists($viewFile)) {
      // Simply include the view file
      // Views that have their own HTML will render as full pages
      // Views that are partials will be included in the layout
      require $viewFile;
    } else {
      http_response_code(404);
      echo "Vista no encontrada: $view";
    }
  }

  protected function json(array $data, int $statusCode = 200): void
  {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  protected function redirect(string $url): void
  {
    header("Location: $url");
    exit();
  }

  protected function isPost(): bool
  {
    return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST';
  }

  protected function isAjax(): bool
  {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
  }

  protected function getInput(string $key, $default = null)
  {
    return $_POST[$key] ?? $_GET[$key] ?? $default;
  }

  protected function getAllInputs(): array
  {
    return $_POST + $_GET;
  }

  protected function sanitize(string $value): string
  {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
  }
}
