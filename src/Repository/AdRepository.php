<?php

declare(strict_types=1);

namespace App\Repository;

class AdRepository extends Repository
{
    public function createAd(string $text, int $price, int $limit, string $banner)
    {
        $this->executeQuery(
            'INSERT INTO ad(text, price, view_limit, banner) VALUES(:text, :price, :limit, :banner)',
            [
                'text' => $text,
                'price' => $price,
                'limit' => $limit,
                'banner' => $banner
            ]
        );
    }

    public function findOneById(int $id)
    {
        $res = $this->pdo->query('SELECT * FROM ad');
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }
}