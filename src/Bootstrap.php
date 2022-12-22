<?php

use App\config\route\RouterClass;
use App\Container;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

$routeClass = new RouterClass();
$routeControllerClass = $routeClass->getClassName();
$routeControllerClassMethod = $routeClass->getClassMethodName();
$methodParameters = $routeClass->getMethodParameters();
$container = new Container();
try {
    $controller = $container->get($routeControllerClass);
    call_user_func_array([$controller, $routeControllerClassMethod], $methodParameters);
} catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
    echo $e->getMessage();
} catch (ReflectionException $e) {
    echo $e->getMessage();
}
