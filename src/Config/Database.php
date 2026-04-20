<?php

namespace App\Config;

use PDO;

class Database
{
  private static ?PDO $connection = null;

  public static function getConnection(): PDO
  {
    if (self::$connection === null) {
      self::connect();
    }
    return self::$connection;
  }

  private static function connect(): void
  {
    $host = 'localhost';
    $port = '3306';
    $dbname = 'tienda';
    $user = 'root';
    $password = 'television07';

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

    try {
      self::$connection = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
      ]);
    } catch (\Throwable $e) {
      die("Error de conexión: " . $e->getMessage());
    }
  }

  public static function disconnect(): void
  {
    self::$connection = null;
  }
}
