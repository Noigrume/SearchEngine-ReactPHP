<?php

namespace App\Config;

class Database
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->initPDOConnection();
    }

    /**
     * Create PDO from connection parameters
     */
    function initPDOConnection(): \PDO
    {
        $dsn = 'mysql:host=' . BDD_HOST . ';dbname=' . BDD_NAME . ';charset=utf8';

        try {
            $pdo = new \PDO(
                $dsn, // Data Source Name
                BDD_USER,
                BDD_PASSWORD,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );

            return $pdo;
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }


    /**
     * Prepare & execute SQL query
     */
    function executeQuery(string $sql, array $values = []): \PDOStatement
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($values);
        return $query;
    }

    /**
     * Execute query & Return multiples results 
     */
    function fetchAllRows(string $sql, array $values = []): array
    {
        $query = $this->executeQuery($sql, $values);
        return $query->fetchAll();
    }
}
