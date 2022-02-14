<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AdService;
use Symfony\Component\HttpFoundation\Response;

class AdController extends AbstractController
{
    private AdService $adService;

    public function __construct()
    {
        $this->adService = new AdService();
    }

    public function createAd(array $params): Response
    {
        $res = $this->adService->createAd($params);

        return $this->json($res);
    }

    public function getAd(): Response
    {
        $res = $this->adService->getRelevant();

        return $this->json($res);
    }

    public function updateAd(int $id, array $params): Response
    {
        $res = $this->adService->updateAd($id, $params);

        return $this->json($res);
    }
}