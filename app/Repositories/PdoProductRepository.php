<?php

namespace App\Repositories;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

class PdoProductRepository
{
    public function connect(): Connection
    {
        return DriverManager::getConnection($this->getParams());
    }

    public function queryBuilder(): QueryBuilder
    {
        return $this->connect()->createQueryBuilder();
    }

    private function getParams(): array
    {
        return [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['USER'],
            'password' => $_ENV['PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER'],
        ];
    }
}