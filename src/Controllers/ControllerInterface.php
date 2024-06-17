<?php

namespace src\Controllers;

interface ControllerInterface
{
    public function get(): void;

    public function post(): void;

    public function update(): void;

    public function delete(): void;

}