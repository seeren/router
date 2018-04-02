<?php

/**
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @author (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/router
 * @version 2.0.1
 */

namespace Seeren\Router;

use Psr\Http\Message\ServerRequestInterface;
use Seeren\Router\Route\RouteInterface;
use Seeren\Router\Factory\RouteFactoryInterface;
use Seeren\Router\Route\Route;
use Seeren\Router\Exception\RouterException;

/**
 * Interface for route controller
 * 
 * @category Seeren
 * @package Router
 */
interface RouterInterface extends RouteFactoryInterface
{

    /**
     * Add route
     *
     * @param Route $route route
     * @return RouterInterface router
     */
    public function add(RouteInterface $route): RouterInterface;


   /**
    * Match route
    *
    * @param ServerRequestInterface $request http request
    * @return RouteInterface route
    * 
    * @throws RouterException on failure
    */
   public function match(ServerRequestInterface &$request): RouteInterface;

   /**
    * Import JSON file configuration
    *
    * @param string $fileName file name
    * @return RouteInterface route
    * 
    * @throws \InvalidArgumentException on faillure
    */
   public function import(string $fileName): RouterInterface;

}
