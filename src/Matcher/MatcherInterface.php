<?php

namespace Seeren\Router\Matcher;

use Seeren\Router\Exception\MethodException;
use Seeren\Router\Exception\RouteException;
use Seeren\Router\Route\RouteInterface;

interface MatcherInterface
{

    /**
     * @param RouteInterface $route
     * @return RouteInterface|null
     * @throws MethodException
     * @throws RouteException
     */
    public function match(RouteInterface $route): ?RouteInterface;

}
