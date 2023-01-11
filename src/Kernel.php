<?php

namespace App;

/**
 * @Kernal
 * @package App
 * get route name and load all class dependancies via container
 * run class method
 */

use App\Config\Route\Router;
use App\Container;

class Kernel
{
    private Router $router;
    private Container $container;

    public function __construct(Router $router, Container $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function run()
    {
        try {
            call_user_func_array([
                $this->container->get($this->router->getClassName()),
                $this->router->getClassMethodName()
            ], $this->router->getMethodParameters());
        } catch (\Throwable $e) {
            print_r($e->getMessage());
        }
    }
}
