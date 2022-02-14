<?php

declare(strict_types=1);

namespace App;

use App\Component\Router;
use App\Validator\RequestParamValidator;
use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Kernel
{
    private Response $response;

    public function __construct(Request $request)
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();

        $this->defineRoute($request);
    }

    public function response(): Response
    {
        return $this->response->send();
    }

    private function defineRoute(Request $request)
    {
        $this->response = Router::defineRoute(
            $request->server->get('REQUEST_URI'),
            $request->server->get('REQUEST_METHOD'),
            $request->request->all()
        );
    }
}