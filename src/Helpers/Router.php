<?php

namespace src\Helpers;
use src\Controllers\NotFoundController;

class Router
{
    protected $routes = [];

    public function addRoutes($route, $controller)
    {
        $this->routes[$route] = ['controller' => $controller];
    }

    public function run($uri)
    {
        $uriArray = explode('/', $uri);
        $args = count($uriArray) > 2 ? array_slice($uriArray, 2) : [];

        if (array_key_exists($uriArray[1], $this->routes)) {
            $controller = $this->routes[$uriArray[1]]['controller'];
            $action = strtolower($_SERVER['REQUEST_METHOD']);

            $controller = new $controller();
            if (!method_exists($controller, $action)) {
                die(405);
            }
            $controller->$action(...$args);
        } else {
            (new NotFoundController())->get();
        }
    }
}