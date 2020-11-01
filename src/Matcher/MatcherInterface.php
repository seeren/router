<?php

namespace Seeren\Router\Matcher;

use Seeren\Router\Exception\MethodException;
use Seeren\Router\Exception\RouteException;
use Seeren\Router\Route\RouteInterface;

/**
 * Interface to represent a matcher
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Router
 */
interface MatcherInterface
{

    /**
     * @param array $route
     * @return RouteInterface|null
     * @throws MethodException
     * @throws RouteException
     */
    public function match(array $route): ?RouteInterface;

}
