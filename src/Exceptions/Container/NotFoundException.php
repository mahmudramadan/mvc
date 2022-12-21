<?php

namespace App\Exceptions\Container;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \Exception implements NotFoundExceptionInterface
{

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
    }
}
