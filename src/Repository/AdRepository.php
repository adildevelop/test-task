<?php

declare(strict_types=1);

namespace App\Repository;

class AdRepository extends AbstractRepository
{
    /**
     * Repository method for creating Ad in DB
     *
     * @param string $text
     * @param int $price
     * @param int $limit
     * @param string $banner
     * @return array|null
     */
    public function createAd(string $text, int $price, int $limit, string $banner): ?array
    {
        return $this->fetch('INSERT INTO ad(text, price, view_limit, banner) VALUES(:text, :price, :limit, :banner) RETURNING id, text, banner', [
            'text' => $text,
            'price' => $price,
            'limit' => $limit,
            'banner' => $banner
        ]);
    }

    /**
     * Repository method for get relevant Ad from DB
     *
     * @return array|null
     */
    public function findRelevant(): ?array
    {
        return $this->fetch('UPDATE ad SET view_count = view_count + 1 WHERE price = (SELECT MAX(price) FROM ad WHERE view_count < view_limit) RETURNING id, text, banner');
    }

    /**
     * Repository method for updating Ad in DB
     *
     * @param int $id
     * @param string $text
     * @param int $price
     * @param int $limit
     * @param string $banner
     * @return array|null
     */
    public function updateAd(int $id, string $text, int $price, int $limit, string $banner): ?array
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