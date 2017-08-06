<?php

/**
 * This file contain Seeren\Router\Test\Route\RouteTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/router
 * @version 1.0.1
 */

namespace Seeren\Router\Test\Route;

use Seeren\Router\Route\RouteInterface;
use Seeren\Router\Route\Route;
use ReflectionClass;

/**
 * Class for test Route
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Route
 */
class RouteTest extends AbstractRouteTest
{

   /**
    * Get RouteInterface
    * 
    * @return RouteInterface route
    */
    protected function getRoute(): RouteInterface
    {
        return (new ReflectionClass(Route::class))->newInstanceArgs([]);
    }

    /**
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Route\Route::__toString
     */
    public function test__toString()
    {
        $this->assertTrue(
            (string) $this->getRoute()
            ->setAction("get")
            ->setController("DummyController")
            ->setParam([true])
            ->setPath("/")
            ->setPrefix("DummyPrefix")
        === "DummyPrefix\Controller\\DummyController"
        );
    }

    /**
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::clone
     */
    public function testClone()
    {
        parent::testClone();
    }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setAction
    * @covers \Seeren\Router\Route\Route::getAction
    */
   public function testSetAction()
   {
       parent::testSetAction();
   }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setPrefix
    * @covers \Seeren\Router\Route\Route::getPrefix
    */
   public function testSetPrefix()
   {
       parent::testSetPrefix();
   }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setPrefix
    * @expectedException \InvalidArgumentException
    */
   public function testSetPrefixInvalidArgumentException()
   {
       parent::testSetPrefixInvalidArgumentException();
   }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setController
    * @covers \Seeren\Router\Route\Route::getController
    */
   public function testSetController()
   {
       parent::testSetController();
   }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setController
    * @expectedException \InvalidArgumentException
    */
   public function testSetControllerInvalidArgumentException()
   {
       parent::testSetControllerInvalidArgumentException();
   }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setParam
    * @covers \Seeren\Router\Route\Route::getParam
    */
   public function testSetParam()
   {
       parent::testSetParam();
   }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setPath
    * @covers \Seeren\Router\Route\Route::getPath
    */
   public function testSetPath()
   {
       parent::testSetPath();
   }

   /**
    * @covers \Seeren\Router\Route\Route::__construct
    * @covers \Seeren\Router\Route\Route::setPath
    * @expectedException \InvalidArgumentException
    */
   public function testSetPathInvalidArgumentException()
   {
       parent::testSetPathInvalidArgumentException();
   }

}
