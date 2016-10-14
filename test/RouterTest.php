<?php

/**
 * This file contain Seeren\Router\Test\RouteInterfaceTest class
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

namespace Seeren\Router\Test;

use Seeren\Router\RouterInterface;
use Seeren\Router\Router;
use Seeren\Router\Factory\RouteFactory;
use Seeren\Router\Matcher\Matcher;
use Seeren\Router\Route\Route;
use ReflectionClass;

/**
 * Class for test Route
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test
 * @abstract
 */
class RouterTest extends RouterInterfaceTest
{

   /**
    * Get RouterInterface
    * 
    * @return RouterInterface router
    */
   protected function getRouterInterface(): RouterInterface
   {
       return (new ReflectionClass(Router::class))->newInstanceArgs([
          (new ReflectionClass(RouteFactory::class))->newInstanceArgs([
              (new ReflectionClass(Route::class))->newInstanceArgs([])         
          ]),
          (new ReflectionClass(Matcher::class))->newInstanceArgs([])
       ]);
   }

}
