<?php

declare(strict_types=1);

namespace App\Tests;

use App\Service\AdService;
use PHPUnit\Framework\TestCase;

final class AdServiceTest extends TestCase
{
    private AdService $adService;

    protected function setUp(): void
    {
        $this->adService = new AdService();
    }

    public function testCreate(): void
    {
        $this->assertIsArray($this->adService->createAd([
            'text' => 'SomeText',
            'price' => '100',
            'limit' => '20',
            'banner' => 'http://banner.example/link.png'
        ]));
    }

    public function testRelevant(): void
    {
        $this->assertIsArray($this->adService->getRelevant());
    }

    public function testUpdate(): void
    {
        $this->assertIsArray($this->adService->updateAd(1, [
            'text' => 'Updated One',
            'price' => '50',
            'limit' => '15',
            'banner' => 'http://banner.example/new-link.png'
        ]));
    }
}