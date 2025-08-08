<?php

namespace App\controllers;

use Yuki\core\Controller;
use Yuki\http\Response;

class PostController extends Controller
{
  public function index(): Response
  {
    return $this->render('posts/index', [
      'title' => 'Post List',
    ]);
  }

  public function show(int $id): Response
  {
    return $this->render('posts/[id]', [
      'title' => 'Post ' . $id,
    ]);
  }

  public function create(): Response
  {
    return $this->render('posts/create', [
      'title' => 'Create Post',
    ]);
  }

  public function store(): void
  {
    echo '<pre>';
    print_r($this->request->body());
    echo '</pre>';
  }
}
