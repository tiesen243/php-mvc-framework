
<?php
use Yuki\http\Kernel;
use Yuki\http\Request;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

require_once BASE_PATH . '/src/env.php';
loadEnv(__DIR__ . '/../.env');

$request = Request::create();

$kernel = new Kernel();
$response = $kernel->handle($request);
$response->send();

