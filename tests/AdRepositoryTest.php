<?php

declare(strict_types=1);

namespace App\Tests;

use App\Repository\AdRepository;
use PHPUnit\Framework\TestCase;

final class AdRepositoryTest extends TestCase
{
    private AdRepository $adRepository;

    protected function setUp(): void
    {
        $this->adRepository = new AdRepository();
    }

    public function testCreate(): void
    {
        $this->assertIsArray($this->adRepository->createAd(
            'SomeText', 100, 20, 'http://banner.example/link.png'
        ));
    }

    public function testRelevant(): void
    {
        $this->assertIsArray($this->adRepository->findRelevant());
    }

    public function testUpdate(): void
    {
        $this->assertIsArray($this->adRepository->updateAd(
            1,'SomeText', 50, 10, 'http://banner.example/new-link.png'
        ));
    }
}