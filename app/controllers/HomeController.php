<?php

namespace App\controllers;

use Yuki\core\Controller;
use Yuki\http\Response;

class HomeController extends Controller
{
  public function index(): Response
  {
    return $this->render('index', [
      'title' => 'cac lo',
    ]);
  }
}
