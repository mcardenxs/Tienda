<?php

namespace App\Core;

class Session
{
  public static function start(): void
  {
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
      session_start();
    }
  }

  public static function set(string $key, $value): void
  {
    self::start();
    $_SESSION[$key] = $value;
  }

  public static function get(string $key, $default = null)
  {
    self::start();
    return $_SESSION[$key] ?? $default;
  }

  public static function has(string $key): bool
  {
    self::start();
    return isset($_SESSION[$key]);
  }

  public static function remove(string $key): void
  {
    self::start();
    unset($_SESSION[$key]);
  }

  public static function destroy(): void
  {
    self::start();
    session_destroy();
  }

  public static function isLoggedIn(): bool
  {
    self::start();
    return isset($_SESSION['usuario']);
  }

  public static function requireAuth(): void
  {
    if (!self::isLoggedIn()) {
      self::destroy();
      header("Location: /Tienda/public/");
      exit();
    }
  }

  public static function getUser(): ?string
  {
    self::start();
    return $_SESSION['usuario'] ?? null;
  }

  public static function getRole(): ?string
  {
    self::start();
    return $_SESSION['rol'] ?? null;
  }
}
