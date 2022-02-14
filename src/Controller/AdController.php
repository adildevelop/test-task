<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AdService;
use Symfony\Component\HttpFoundation\Response;

class AdController extends AbstractController
{
    /**
     * @var AdService
     */
    private AdService $adService;

    public function __construct()
    {
        $this->adService = new AdService();
    }

    /**
     * Controller method for creating Ad
     *
     * @param array $params
     * @return Response
     */
    public function createAd(array $params): Response
    {
        $res = $this->adService->createAd($params);

        return $this->json($res);
    }

    /**
     * Controller method for get relevant Ad
     *
     * @return Response
     */
    public function getAd(): Response
    {
        $res = $this->adService->getRelevant();

        return $this->json($res);
    }

    /**
     * Controller method for updating Ad
     *
     * @param int $id
     * @param array $params
     * @return Response
     */
    public function updateAd(int $id, array $params): Response
    {
        $res = $this->adService->updateAd($id, $params);

        return $this->json($res);
    }
}