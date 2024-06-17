<?php

namespace src\Traits;

trait Singleton
{
    private static array $instances = [];

    public static function getInstance(...$args)
    {
        return static::$instances[static::class] ?? static::$instances[static::class] = new static(...$args);
    }

    private function __construct(...$args)
    {
        $this->init(...$args);
    }

    protected function init(...$args): void
    {
    }

    public function __wakeup()
    {
    }

    private function __clone()
    {
    }
}