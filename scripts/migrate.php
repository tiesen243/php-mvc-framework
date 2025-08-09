<?php

use Yuki\core\Database;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/src/env.php';
loadEnv(__DIR__ . '/../.env');

$db = Database::init(
  '127.0.0.1',
  $_ENV['DB_NAME'],
  $_ENV['DB_USER'],
  $_ENV['DB_PASSWORD'],
);

// Create the 'users' table if it does not exist
$statement = $db->pdo->prepare("
      CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )
");
$statement->execute();

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
