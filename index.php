<?php
require './vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

use src\Controllers\ProductController;
use src\Controllers\UserController;
use src\Helpers\Router;

$router = new Router();

$router->addRoutes('users', UserController::class);
$router->addRoutes('products', ProductController::class);

$router->run($uri);