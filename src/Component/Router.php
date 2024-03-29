<?php

declare(strict_types=1);

namespace App\Component;

use App\Controller\AdController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Router
{
    /**
     * Routing logic imitation method
     *
     * @param string $uri
     * @param string $method
     * @param array|null $params
     * @return Response
     */
    public static function defineRoute(string $uri, string $method, ?array $params = null): Response
    {
        $controller = new AdController();
        if ($method === 'POST' && $exceptionResponse = $controller->nullOrExceptionResponse($params)) {
            return $exceptionResponse;
        }

        if ($uri === '/ads' && $method === 'POST') {
            $res = $controller->createAd($params);
        }  elseif ($uri === '/ads/relevant' && $method === 'GET') {
            $res = $controller->getAd();
        } elseif (preg_match('/\/ads\/(\d+)/', $uri, $id) && $method === 'POST') {
            $res = $controller->updateAd(intval($id[1]), $params);
        } else {
            $res = new JsonResponse([
                'code' => '404',
                'message' => 'Not Found'
            ], 404);
        }

        return $res;
    }
}