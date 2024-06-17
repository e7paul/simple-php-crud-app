<?php

namespace src\Helpers;

use PDO;
use src\Traits\Singleton;

class ORM
{
    use Singleton;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=db;dbname=main", "user", "password");
    }

    /**
     * @param string $table
     * @param array $what
     * @param array $where
     * @param ORMJoiner[] $joiners
     * @param array $orderBy
     * @return array|false
     */
    public function select(string $table, array $what = ['*'], array $joiners = [], array $where = [], array $orderBy = []): array|false
    {
        $columns = implode(',', $what);
        $keys = array_keys($where);
        $params = array_values($where);
        $query = "SELECT $columns FROM $table";

        if ($joiners) {
            foreach ($joiners as $joiner) {
                if ($joiner instanceof ORMJoiner) {
                    $query .= " $joiner->type JOIN $joiner->joinTable on $joiner->joinTable.$joiner->joinTableKey 
                        = $joiner->baseTableKey";
                }
            }
        }

        if ($keys && $params) {
            $query .= ' WHERE ';
            $query .= implode(' AND ', array_map(static function($el) {
                return "$el = ?";
            }, $keys));
        }

        if ($orderBy) {
            $query .= ' ORDER BY ';
            $query .= implode(', ', array_map(static function($key, $order) {
                return "$key $order";
            }, array_keys($orderBy), $orderBy));
        }

        $statement = $this->conn->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table
     * @param array $values
     * @return bool
     */
    public function insert(string $table, array $values): bool
    {
        if (!$values) {
            return false;
        }
        $keys = implode(', ', array_keys($values));
        $valuesString = implode(', ', array_fill(0, count($values), '?'));
        $actualValues = array_values($values);

        $query = "INSERT INTO $table ($keys) VALUES ($valuesString)";
        return $this->conn->prepare($query)->execute($actualValues);
    }

    public function insertMultiple(string $table, array $values): bool
    {
        if (!$values) {
            return false;
        }
        $keys = implode(', ', array_keys($values));
        $valuesString = '(' . implode(', ', array_fill(0, count($values), '?')) . ')';
        $firstValue = reset($values);
        $valuesString = implode(', ', array_fill(0, count($firstValue), $valuesString));

        $query = "INSERT INTO $table ($keys) VALUES $valuesString";
        return $this->conn->prepare($query)->execute(array_merge(...array_values($values)));
    }
}