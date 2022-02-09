<?php

declare(strict_types=1);

use App\Component\Router;
use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$response = Router::defineRoute(
    $request->server->get('REQUEST_URI'),
    $request->server->get('REQUEST_METHOD'),
    $request->request->all()
);

return $response->send();