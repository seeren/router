<?php

/**
 * This file contain Seeren\Router\Test\Route\RouteInterfaceTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.0.1
 */

namespace Seeren\Router\Test\Route;

use Seeren\Router\Route\Route;
use Seeren\Router\Route\RouteInterface;
use ReflectionClass;

/**
 * Class for test Route
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Route
 * @abstract
 */
class RouteTest extends RouteInterfaceTest
{

   /**
    * Get RouteInterface
    * 
    * @return RouteInterface route
    */
   protected function getRouteInterface(): RouteInterface
   {
       return (new ReflectionClass(Route::class))->newInstanceArgs([]);
   }

}
