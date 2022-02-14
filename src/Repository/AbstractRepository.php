<?php

declare(strict_types=1);

namespace App\Repository;

abstract class AbstractRepository
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(
            'pgsql:dbname='.$_ENV['DATABASE_NAME'].';host='.$_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    protected function fetch(string $query, ?array $params = null): array
    {
        $res = $this->executeQuery($query, $params);

        return $res->fetch(\PDO::FETCH_ASSOC);
    }

    private function executeQuery(string $query, ?array $params): \PDOStatement
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