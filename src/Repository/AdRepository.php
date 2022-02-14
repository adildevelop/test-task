<?php

declare(strict_types=1);

namespace App\Repository;

class AdRepository extends AbstractRepository
{
    public function createAd(string $text, int $price, int $limit, string $banner): array
    {
        return $this->fetch('INSERT INTO ad(text, price, view_limit, banner) VALUES(:text, :price, :limit, :banner) RETURNING id, text, banner', [
            'text' => $text,
            'price' => $price,
            'limit' => $limit,
            'banner' => $banner
        ]);
    }

    public function findRelevant(): array
    {
        return $this->fetch('UPDATE ad SET view_count = view_count + 1 WHERE price = (SELECT MAX(price) FROM ad WHERE view_count < view_limit) RETURNING id, text, banner');
    }

    public function updateAd(int $id, string $text, int $price, int $limit, string $banner): array
    {
        return $this->fetch('UPDATE ad SET text=:text, price=:price, view_limit=:limit, banner=:banner WHERE id=:id RETURNING id, text, banner', [
            'id' => $id,
            'text' => $text,
            'price' => $price,
            'limit' => $limit,
            'banner' => $banner
        ]);
    }
}