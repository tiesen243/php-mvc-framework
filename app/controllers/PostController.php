<?php

namespace App\controllers;

use Yuki\http\Response;

class PostController
{
  public function show(int $id): Response
  {
    $content = "Showing post with ID: $id";
    return new Response($content);
  }
}
