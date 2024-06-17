<?php

namespace src\Models;

use src\Helpers\ORM;

class ProductModel implements ModelInterface
{
    private static string $table = 'products';

    /**
     * @param int|null $id
     * @return string|false
     * @throws \JsonException
     */
    public static function get(int $id = null): string|false
    {
        $orm = ORM::getInstance();

        $what = ['*'];
        if ($id) {
            $where = ['id' => $id];
        }
        $result = $orm->select(
            self::$table,
            $what,
            [],
            $where ?? [],
            []
        );
        return json_encode($result, JSON_THROW_ON_ERROR);
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function create(array $data): bool
    {
        // здесь должна быть валидация согласно требованиям от ProductEntity
        $data = ['title' => (string)$data['title'], 'price' => (int)$data['price']];
        return (ORM::getInstance())->insert(self::$table, $data);
    }

    public static function createMultiple(array $data): bool
    {
        // здесь должна быть валидация согласно требованиям от ProductEntity
        $data = ['title' => array_map(static function($el) {
            return (string)$el;
        }, $data['title']), 'price' => array_map(static function($el) {
            return (int)$el;
        }, $data['price'])];
        return (ORM::getInstance())->insertMultiple(self::$table, $data);
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