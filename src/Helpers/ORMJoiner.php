<?php

namespace src\Helpers;

class ORMJoiner
{
    public function __construct(
        public string $type,
        public string $joinTable,
        public string $joinTableKey,
        public string $baseTableKey
    ) {}
}