<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;
use PDOStatement;

abstract class AbstractRepository
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'pgsql:dbname='.$_ENV['DATABASE_NAME'].';host='.$_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    /**
     * Method for fetching data from DB
     * @param string $query
     * @param array|null $params
     * @return array
     */
    protected function fetch(string $query, ?array $params = null): array
    {
        $res = $this->executeQuery($query, $params);

        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Basic private method to safely execute query to DB
     *
     * @param string $query
     * @param array|null $params
     * @return PDOStatement
     */
    private function executeQuery(string $query, ?array $params): PDOStatement
    {
        $this->pdo->beginTransaction();

        try {
            $statement = $this->pdo->prepare($query);
            (null === $params) ? $statement->execute() : $statement->execute($params);
            $this->pdo->commit();
        } catch (\PDOException $exception) {
            $this->pdo->rollBack();
            throw new \PDOException('There was some error while executing query');
        }

        return $statement;
    }
}