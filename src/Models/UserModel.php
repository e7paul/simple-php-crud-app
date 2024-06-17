<?php

namespace src\Models;

use src\Helpers\ORM;
use src\Helpers\ORMJoiner;

class UserModel implements ModelInterface
{
    private static string $table = 'user';

    /**
     * @param int|null $id
     * @return string|false
     * @throws \JsonException
     */
    public static function get(int $id = null): string|false
    {
        $orm = ORM::getInstance();

        $what = ['user.id', 'CONCAT(first_name, " ", second_name) as fio'];
        if ($id) {
            $what[] = 'title';
            $what[] = 'price';
            $where = ['user.id' => $id];
            $joiners[] = new ORMJoiner('INNER', 'user_order', 'user_id', 'user.id');
            $joiners[] = new ORMJoiner('INNER', 'products', 'id', 'user_order.product_id');
            $orderBy = ['title' => 'ASC', 'price' => 'DESC'];
        }
        $result = $orm->select(
            self::$table,
            $what,
            $joiners ?? [],
            $where ?? [],
            $orderBy ?? []
        );
        return json_encode($result, JSON_THROW_ON_ERROR);
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function create(array $data): bool
    {
        return '';
    }

    public static function update(array $data): bool
    {
        return '';
    }

    public static function delete(int $id): bool
    {
        return '';
    }
}