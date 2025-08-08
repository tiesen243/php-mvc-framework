<?php

namespace Yuki\http;

class Request
{
  private static $instance = null;

  public function __construct(
    private array $server,
    private array $get,
    private array $post,
    private array $files,
    private array $cookies,
    private array $env,
  ) {}

  public static function create(): static
  {
    if (self::$instance === null) {
      static::$instance = new static(
        $_SERVER,
        $_GET,
        $_POST,
        $_FILES,
        $_COOKIE,
        $_ENV,
      );
    }

    return self::$instance;
  }

  public function getRequestInfo(): array
  {
    $uri = $this->server['PATH_INFO'] ?? '/';

    return [
      'method' => $this->server['REQUEST_METHOD'] ?? 'GET',
      'uri' => $uri === '/' ? '/' : rtrim($uri, '/'),
    ];
  }

  public function body(): array
  {
    return $this->post;
  }
}
