<?php /** @noinspection PhpCSValidationInspection */

namespace App;

use App\Exceptions\Container\ContainerException;
use App\Exceptions\Container\NotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;

class Container implements ContainerInterface
{
    private array $entries = [];


    /**
     * @param string $id
     * @return mixed|object
     * @throws ContainerException
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            return $entry($this);
        }
        return $this->resolve($id);
    }

    /**
     * @param string $id
     * @return void
     */
    public function has(string $id)
    {
        isset($this->entries[$id]);
    }

    /**
     * @param string $id
     * @param callable $concrete
     */
    public function set(string $id, callable $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * @param string $id
     * @return object
     * @throws ContainerException
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function resolve(string $id): object
    {
        $reflectionClass = new ReflectionClass($id);
        if (!$reflectionClass->isInstantiable()) {
            throw new NotFoundException("class $id is not instantiable");
        }
        return $this->getInstance($reflectionClass);
    }


    /**
     * @param ReflectionClass $reflectionClass
     * @return object
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function getInstance(ReflectionClass $reflectionClass): object
    {
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return $reflectionClass->newInstance();
        }

        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return $reflectionClass->newInstance();
        }
        $dependencies = $this->getDependencies($reflectionClass, $parameters);
        return $reflectionClass->newInstanceArgs(
            $dependencies
        );
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @param array $parameters
     * @return array
     * @throws ContainerException
     * @throws ReflectionException|NotFoundException
     */
    public function getDependencies(ReflectionClass $reflectionClass, array $parameters): array
    {
        return array_map(
            function ($parameter) use ($reflectionClass) {
                $type = $parameter->getType();
                $name = $parameter->getName();
                if (!$type) {
                    throw new ContainerException("class " . $reflectionClass->getName() . " failed to resolve because parameter $name is missing type hint ");
                }
                if ($parameter->getClass() === null) {
                    return $parameter->getDefaultValue();
                }
                return $this->get($type->getName());
            }
            , $parameters);
    }


    /**
     * @param string $id
     * @param string $method
     * @return array|null
     * @throws ContainerException
     * @throws ReflectionException|NotFoundException
     */
    public function getMethodEntries(string $id, string $method): ?array
    {
        $reflectionClass = new ReflectionClass($id);
        $methodData = $reflectionClass->getMethod($method);
        $parameters = $methodData->getParameters();
        return array_filter($this->getDependencies($reflectionClass, $parameters));
    }
}
