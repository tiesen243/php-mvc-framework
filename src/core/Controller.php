<?php

namespace Yuki\core;

use Yuki\http\Request;
use Yuki\http\Response;

class Controller
{
  protected ?Request $request = null;

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

  public function setRequest(Request $request): void
  {
    $this->request = $request;
  }
}
