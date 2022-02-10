<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AdService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdController
{
    private AdService $adService;

    public function __construct()
    {
        $this->adService = new AdService();
    }

    public function createAd(array $params): Response
    {
        $this->adService->createAd($params);

        return new JsonResponse();
    }

    public function getAd(): Response
    {
        $res = $this->adService->getRelevant();

        return new JsonResponse($res);
    }

    public function updateAd(int $id, array $params): Response
    {
        $res = $this->adService->updateAd($id, $params);

        return new JsonResponse($res);
    }
}