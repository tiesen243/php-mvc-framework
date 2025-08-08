<?php

namespace App\http;

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
}
