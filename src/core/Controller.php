<?php

namespace Yuki\core;

use Yuki\http\Response;

class Controller
{
  public function render(string $template, ?array $vars = []): Response
  {
    $templatePath = BASE_PATH . '/app/views/' . $template . '.html';
    if (!file_exists($templatePath)) {
      throw new \Exception('Template not found: ' . $templatePath);
    }

    ob_start();
    extract($vars);
    require $templatePath;
    $content = ob_get_clean();
    return new Response($content);
  }
}
