<?php

namespace App\Exceptions\Container;

use Psr\Container\ContainerExceptionInterface;

class ContainerException extends \Exception implements ContainerExceptionInterface
{

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
    }
}
