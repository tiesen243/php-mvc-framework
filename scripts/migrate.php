<?php

use Yuki\core\Database;

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/src/configs/env.php';
loadEnv(__DIR__ . '/../.env');

$db = Database::init(
  '127.0.0.1',
  $_ENV['DB_NAME'],
  $_ENV['DB_USER'],
  $_ENV['DB_PASSWORD'],
);

// Create the 'posts' table if it does not exist
$statement = $db->pdo->prepare("
      CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )
");
$statement->execute();
