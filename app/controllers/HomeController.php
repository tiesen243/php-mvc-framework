<?php

namespace App\controllers;

use Yuki\http\Response;

class HomeController
{
  public function index(): Response
  {
    $content = 'dsadsads';
    return new Response($content);
  }
}
