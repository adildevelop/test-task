<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AdRepository;

class AdService
{
    /**
     * @var AdRepository
     */
    private AdRepository $adRepository;

    public function __construct()
    {
        $this->adRepository = new AdRepository();
    }

    /**
     * Service method for creating Ad
     *
     * @param array $params
     * @return array
     */
    public function createAd(array $params): array
    {
        return $this->adRepository->createAd($params['text'], (int) $params['price'], (int) $params['limit'], $params['banner']);
    }

    /**
     * Service method for get relevant Ad
     *
     * @return array
     */
    public function getRelevant(): array
    {
        return $this->adRepository->findRelevant();
    }

    /**
     * Service method for updating Ad
     *
     * @param int $id
     * @param array $params
     * @return array
     */
    public function updateAd(int $id, array $params): array
    {
        return $this->adRepository->updateAd($id, $params['text'], (int) $params['price'], (int) $params['limit'], $params['banner']);
    }
}