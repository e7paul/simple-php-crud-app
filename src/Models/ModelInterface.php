<?php

namespace src\Models;

interface ModelInterface
{
    public static function get(int $id = null): string|false;

    public static function create(array $data): bool;

    public static function update(array $data): bool;

    public static function delete(int $id): bool;

}