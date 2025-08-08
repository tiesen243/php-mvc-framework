<?php

namespace App\http;

class Kernel
{
  public function handle(Request $request): Response
  {
    $content = 'Hello, World!';
    return new Response($content);
  }
}
