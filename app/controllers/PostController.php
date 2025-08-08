<?php

namespace App\controllers;

use App\models\Post;
use Yuki\core\Controller;
use Yuki\core\Database;
use Yuki\http\Response;

class PostController extends Controller
{
  public function index(): Response
  {
    $db = Database::get();
    $statement = $db->pdo->prepare('SELECT * FROM posts');
    $statement->execute();
    $posts = $statement->fetchAll();

    return $this->render('posts/index', [
      'title' => 'Posts',
      'posts' => $posts,
    ]);
  }

  public function show(int $id): Response
  {
    $db = Database::get();
    $statement = $db->pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $statement->bindParam(':id', $id, \PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetch();

    return $this->render('posts/[id]/index', [
      'title' => $post['title'] ?? 'Post Not Found',
      'post' => $post,
    ]);
  }

  public function create(): Response
  {
    return $this->render('posts/create', [
      'title' => 'Create Post',
    ]);
  }

  public function store(): Response
  {
    $body = $this->request->body();
    $post = new Post();
    $post->setTitle($body['title'] ?? '');
    $post->setContent($body['content'] ?? '');
    $post->save();

    header('Location: /posts');
    exit();
  }

  public function edit(int $id): Response
  {
    $db = Database::get();
    $statement = $db->pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $statement->bindParam(':id', $id, \PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetch();

    return $this->render('posts/[id]/edit', [
      'title' => 'Edit Post',
      'post' => $post,
    ]);
  }

  public function update(int $id): Response
  {
    $body = $this->request->body();

    $post = new Post();
    $post->setId($id);
    $post->setTitle($body['title'] ?? '');
    $post->setContent($body['content'] ?? '');
    $post->update();

    header('Location: /posts/' . $id);
    exit();
  }

  public function delete()
  {
    $body = $this->request->body();

    $post = new Post();
    $post->setId((int) ($body['id'] ?? 0));
    $post->delete();

    header('Location: /posts');
    exit();
  }
}
