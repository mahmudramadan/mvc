<?php

use App\Config\Route\Router;
use App\Container;

$routeClass = new Router();
$routeControllerClass = $routeClass->getClassName();
$routeControllerClassMethod = $routeClass->getClassMethodName();
$methodParameters = $routeClass->getMethodParameters();
$container = new Container();
try {
    $controller = $container->get($routeControllerClass);
    call_user_func_array([$controller, $routeControllerClassMethod], $methodParameters);
} catch (\Throwable $e) {
    echo $e->getMessage();
}
