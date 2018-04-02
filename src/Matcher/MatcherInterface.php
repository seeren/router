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
 * @version 1.0.1
 */

namespace Seeren\Router\Matcher;

use Psr\Http\Message\ServerRequestInterface;
use Seeren\Router\Route\RouteInterface;

/**
 * Interface for match a route
 * 
 * @category Seeren
 * @package Router
 * @subpackage Matcher
 */
interface MatcherInterface
{

   /**
    * Match route
    * 
    * @param ServerRequestInterface $request http request
    * @param RouteInterface $route route
    * @return bool route match or not
    */
   public function match(
       ServerRequestInterface &$request,
       RouteInterface $route): bool;

}
