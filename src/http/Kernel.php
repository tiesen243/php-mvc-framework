<?php

namespace Yuki\http;

use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

class Kernel
{
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

    return call_user_func_array([new $controller(), $method], $vars);
  }
}
