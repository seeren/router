<?php

/**
 * This file contain Seeren\Router\Test\Factory\FactoryTest class
 * 
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.0.1
 */

namespace Seeren\Router\Test\Factory;

use Seeren\Router\Factory\RouteFactoryInterface;
use Seeren\Router\Factory\RouteFactory;
use Seeren\Router\Route\Route;
use ReflectionClass;

/**
 * Class for test RouteFactory
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Factory
 */
class FactoryTest extends AbstractFactoryTest
{

   /**
    * Get RouteFactoryInterface
    * 
    * @return RouteFactoryInterface route factory
    */
   protected function getRouteFactory(): RouteFactoryInterface
   {
       return (new ReflectionClass(RouteFactory::class))->newInstanceArgs([
           (new ReflectionClass(Route::class))->newInstanceArgs([])
       ]);
   }

   /**
    * @covers \Seeren\Router\Factory\RouteFactory::__construct
    * @covers \Seeren\Router\Factory\RouteFactory::create
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::clone
    * @covers \Seeren\Router\Route\Route::setAction
    * @covers \Seeren\Router\Route\Route::setController
    * @covers \Seeren\Router\Route\Route::setParam
    * @covers \Seeren\Router\Route\Route::setPath
    * @covers \Seeren\Router\Route\Route::setPrefix
    */
   public function testCreate()
   {
       parent::testCreate();
   }

   /**
    * @covers \Seeren\Router\Factory\RouteFactory::__construct
    * @covers \Seeren\Router\Factory\RouteFactory::create
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::clone
    * @covers \Seeren\Router\Route\Route::setAction
    * @covers \Seeren\Router\Route\Route::setPrefix
    * @expectedException InvalidArgumentException
    */
   public function testCreateInvalidArgumentException()
   {
       parent::testCreateInvalidArgumentException();
   }

}
