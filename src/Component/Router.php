<?php

declare(strict_types=1);

namespace App\Component;

use App\Controller\AdController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Router
{
    public static function defineRoute(string $uri, string $method, ?array $parameters = null): Response
    {
        $controller = new AdController();

        if ($uri === '/ads' && $method === 'POST') {
            $res = $controller->createAd($parameters);
        }  elseif ($uri === '/ads/relevant' && $method === 'GET') {
            $res = $controller->getAd();
        } elseif ($uri === '/ads' && $method === 'POST') {
            $res = $controller->editAd($parameters);
        } else {
            $res = new JsonResponse([
                'code' => '404',
                'message' => 'Not Found'
            ], 404);
        }

        return $res;
    }
}