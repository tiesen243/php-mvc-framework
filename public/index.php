
<?php
use App\http\Kernel;
use App\http\Request;
use App\http\Response;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$request = Request::create();

$kernel = new Kernel();
$response = $kernel->handle($request);
$response->send();

