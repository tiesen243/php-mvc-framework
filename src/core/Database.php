<?php

namespace Yuki\core;

use PDO;
use PDOException;

class Database
{
  private static $instance = null;
  public ?PDO $pdo = null;

  public function __construct(
    private string $host = 'localhost',
    private string $db_name = 'db',
    private string $db_user = 'root',
    private string $db_password = 'secret',
  ) {
    try {
      $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];

      $this->pdo = new PDO($dsn, $db_user, $db_password, $options);
    } catch (PDOException $e) {
      throw new \Exception('Database connection failed: ' . $e->getMessage());
    }
  }

  public static function init(
    string $host = 'localhost',
    string $db_name = 'db',
    string $db_user = 'root',
    string $db_password = 'secret',
  ): static {
    if (self::$instance === null) {
      self::$instance = new static($host, $db_name, $db_user, $db_password);
    }

    return self::$instance;
  }

  public static function get(): static
  {
    if (self::$instance === null) {
      throw new \Exception(
        'Database not initialized. Call Database::init() first.',
      );
    }

    return self::$instance;
  }
}
