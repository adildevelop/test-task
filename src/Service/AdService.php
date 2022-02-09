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

    public function getOneById()
    {
        return $this->adRepository->findOneById(5);
    }

    public function createAd(string $text, int $price, int $limit, string $banner)
    {
        $this->adRepository->createAd($text, $price, $limit, $banner);
    }
}