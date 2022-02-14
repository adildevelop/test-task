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
    /**
     * @var Response
     */
    private Response $response;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();

        $this->defineRoute($request);
    }

    /**
     * Return response from Kernel
     *
     * @return Response
     */
    public function response(): Response
    {
        return $this->response->send();
    }

    /**
     * Process request to Router
     *
     * @param Request $request
     * @return void
     */
    private function defineRoute(Request $request)
    {
        $this->response = Router::defineRoute(
            $request->server->get('REQUEST_URI'),
            $request->server->get('REQUEST_METHOD'),
            $request->request->all()
        );
    }
}