<?php

namespace App\config\route;

class RouterClass
{
    private array $routes;
    private array $completeUrl;
    private string $routeName;
    private string $requestMethod;
    private string $className;
    private string $classMethodName;
    private array $methodParameters;


    public function __construct()
    {
        $this->routes = require_once __DIR__ . "/route.php";
        $this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        $this->setCompleteUrl();
        $this->setRouteName();
        $this->setClassName();
        $this->setClassMethodName();
        $this->setMethodParameters();
    }

    /**
     * setCompleteUrl
     */
    private function setCompleteUrl(): void
    {

        if (!isset($_SERVER['PATH_INFO'])) {
            $this->completeUrl = ["home"];
        } else {
            $this->completeUrl = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
        }
    }

    /**
     * setRouteName
     */
    private function setRouteName(): void
    {
        $this->routeName =
            (!isset($this->routes[$this->completeUrl[0]])
                || $this->requestMethod != strtolower($this->routes[$this->completeUrl[0]]["requestMethod"]))
            ? "404" : $this->completeUrl[0];
    }


    private function setClassMethodName(): void
    {
        $this->classMethodName = $this->routes[$this->routeName]['methodName'];
    }

    private function setClassName(): void
    {
        $this->className = $this->routes[$this->routeName]['controllerClass'];
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getClassMethodName(): string
    {
        return $this->classMethodName;
    }

    /**
     * @return array
     */
    public function getMethodParameters(): array
    {
        return $this->methodParameters;
    }

    private function setMethodParameters(): void
    {
        $this->methodParameters = array_slice($this->completeUrl, 1);
    }


}
