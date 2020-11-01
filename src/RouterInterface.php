<?php

namespace Seeren\Router;

use Psr\Http\Message\ResponseInterface;
use Seeren\Router\Exception\MethodException;
use Seeren\Router\Exception\NotFoundException;
use Seeren\Router\Exception\RouteException;
use Throwable;

/**
 * Interface to represent a router
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Router
 */
interface RouterInterface
{

    /**
     * @return ResponseInterface
     * @throws NotFoundException
     * @throws MethodException
     * @throws RouteException
     * @throws Throwable
     */
    public function getResponse(): ResponseInterface;

}
