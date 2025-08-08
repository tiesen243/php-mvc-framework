<?php

namespace App\routes;

use App\controllers\HomeController;
use App\controllers\PostController;

return [
  ['GET', '/', [HomeController::class, 'index']],

  ['GET', '/posts', [PostController::class, 'index']],
  ['GET', '/posts/{id:\d+}', [PostController::class, 'show']],

  ['GET', '/posts/create', [PostController::class, 'create']],
  ['POST', '/posts/create', [PostController::class, 'store']],

  ['GET', '/posts/{id:\d+}/edit', [PostController::class, 'edit']],
  ['POST', '/posts/{id:\d+}/edit', [PostController::class, 'update']],

  ['POST', '/posts/delete', [PostController::class, 'delete']],
];
