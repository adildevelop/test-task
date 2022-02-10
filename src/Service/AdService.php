<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AdRepository;

class AdService
{
    private AdRepository $adRepository;

    public function __construct()
    {
        $this->adRepository = new AdRepository();
    }

    public function createAd(array $params): bool
    {
        return $this->adRepository->createAd($params['text'], (int) $params['price'], (int) $params['limit'], $params['banner']);
    }

    public function getRelevant(): array
    {
        return $this->adRepository->findRelevant();
    }

    public function updateAd(int $id, array $params): array
    {
        return $this->adRepository->updateAd($id, $params['text'], (int) $params['price'], (int) $params['limit'], $params['banner']);
    }
}