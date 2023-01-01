<?php
declare(strict_types=1);

namespace App\Config\Route;

/**
 * Router
 *
 * @package App\Config\Route
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class Router
{
    /**
     * all application routes
     * @var array|mixed
     */
    private array $routes;
    /**
     * url segmentation
     * @var array
     */
    private array $urlSegmentation;
    /**
     * route name
     * @var string
     */
    private string $routeName;
    /**
     * request method
     * @var string
     */
    private string $requestMethod;
    /**
     * route class name
     * @var string
     */
    private string $className;
    /**
     * route class method
     * @var string
     */
    private string $classMethodName;
    /**
     * method parameters
     * @var array
     */
    private array $methodParameters;

    public function __construct()
    {
        $this->routes = require_once __DIR__ . "/Web.php";
        $this->setRequestMethod();
        $this->setUrlSegmentation();
        $this->setRouteName();
        $this->setClassName();
        $this->setClassMethodName();
        $this->setMethodParameters();
    }

    /**
     * set Url Segmentation
     */
    private function setUrlSegmentation(): void
    {
        if (!isset($_SERVER['PATH_INFO'])) {
            $this->urlSegmentation = ["home"];
        } else {
            $this->urlSegmentation = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
        }
    }

    /**
     * set Route Name
     */
    private function setRouteName(): void
    {
        $this->routeName = (!isset($this->routes[$this->urlSegmentation[0]]) || $this->requestMethod != strtolower($this->routes[$this->urlSegmentation[0]][0])) ? "404" : $this->urlSegmentation[0];
    }

    /**
     * set Class Method Name
     */
    private function setClassMethodName(): void
    {
        $this->classMethodName = $this->routes[$this->routeName][2];
    }

    /**
     * set Class Name
     */
    private function setClassName(): void
    {
        $this->className = $this->routes[$this->routeName][1];
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

    /**
     * set Method Parameters
     */
    private function setMethodParameters(): void
    {
        $this->methodParameters = array_slice($this->urlSegmentation, 1);
    }

    private function setRequestMethod()
    {
        $this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
    }
}
