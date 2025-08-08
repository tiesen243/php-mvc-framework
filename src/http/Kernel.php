<?php

namespace Yuki\http;

use FastRoute\RouteCollector;
use Yuki\core\Controller;
use Yuki\core\Database;

use function FastRoute\simpleDispatcher;

class Kernel
{
  protected Database $db;

  public function __construct()
  {
    $this->db = Database::init(
      '127.0.0.1',
      $_ENV['DB_NAME'],
      $_ENV['DB_USER'],
      $_ENV['DB_PASSWORD'],
    );
  }

  public function handle(Request $request): Response
  {
    $dispatcher = simpleDispatcher(function (RouteCollector $r) {
      $routes = require_once BASE_PATH . '/app/routes/web.php';

      foreach ($routes as $route) {
        $r->addRoute(...$route);
      }
    });

    $routeInfo = $dispatcher->dispatch(
      $request->getRequestInfo()['method'],
      $request->getRequestInfo()['uri'],
    );

    [, [$controller, $method], $vars] = $routeInfo;
    $controller = new $controller();

    if ($controller instanceof Controller) {
      $controller->setRequest($request);
    }

    return call_user_func_array([$controller, $method], $vars);
  }
}
