<?php

declare(strict_types=1);

namespace App\Repository;

class Repository
{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(
            'pgsql:dbname='.$_ENV['DATABASE_NAME'].';host='.$_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    protected function executeQuery(string $query, ?array $params = null): array
    {
        $this->pdo->beginTransaction();

        try {
            $statement = $this->prepareStatement($query, $params);
            $statement->execute();
            $this->pdo->commit();

            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $exception) {
            $this->pdo->rollBack();
            throw new \PDOException('Something went wrong while executing query');
        }

        return $res;
    }

    private function prepareStatement(string $query, ?array $params = null): \PDOStatement
    {
        $statement = $this->pdo->prepare($query);

        if (null !== $params) {
            foreach ($params as $key => $value) {
                $statement->bindParam(':' . $key, $value);
            }
        }

        return $statement;
    }
}