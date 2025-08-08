<?php

namespace App\models;

use Yuki\core\Database;

class Post
{
  private ?int $id;
  private string $title;
  private string $content;

  public function __construct()
  {
    $db = Database::get();

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
  }

  public function save(): void
  {
    $db = Database::get();

    $statement = $db->pdo->prepare("
      INSERT INTO posts (title, content) 
      VALUES (:title, :content)
    ");
    $statement->bindParam(':title', $this->getTitle());
    $statement->bindParam(':content', $this->getContent());
    $statement->execute();
    $id = $db->pdo->lastInsertId();
    $this->setId($id);
  }

  public function update(): void
  {
    $db = Database::get();

    $statement = $db->pdo->prepare("
      UPDATE posts 
      SET title = :title, content = :content 
      WHERE id = :id
    ");
    $statement->bindParam(':id', $this->getId());
    $statement->bindParam(':title', $this->getTitle());
    $statement->bindParam(':content', $this->getContent());
    $statement->execute();
  }

  public function delete(): void
  {
    $db = Database::get();

    $statement = $db->pdo->prepare("
      DELETE FROM posts 
      WHERE id = :id
    ");
    $statement->bindParam(':id', $this->getId());
    $statement->execute();
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function setContent(string $content): void
  {
    $this->content = $content;
  }
}
