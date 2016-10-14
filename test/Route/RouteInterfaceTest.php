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

use Seeren\Router\Route\RouteInterface;
use stdClass;

/**
 * Class for test RouteInterface
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Route
 * @abstract
 */
abstract class RouteInterfaceTest extends \PHPUnit_Framework_TestCase
{

   /**
    * Get RouteInterface
    * 
    * @return RouteInterface route
    */
   abstract protected function getRouteInterface(): RouteInterface;

   /**
    * Test RouteInterface::setAction
    */
   public final function testSetAction()
   {
       $route = $this->getRouteInterface();
       $route->setAction("FoO");
       $this->assertTrue("foo" === $route->getAction());
   }

   /**
    * Test RouteInterface::setPrefix
    */
   public final function testSetPrefix()
   {
       $route = $this->getRouteInterface();
       $route->setPrefix("Foo/Foo/");
       $this->assertTrue("Foo/Foo" === $route->getPrefix());
   }

   /**
    * Test RouteInterface::setPrefix Exception
    * 
    * @dataProvider setPrefixExceptionProvider
    * @expectedException \InvalidArgumentException
    */
   public final function testSetPrefixException(string $prefix)
   {
       $this->getRouteInterface()->setPrefix($prefix);
   }

   /**
    * Test RouteInterface::setController
    */
   public final function testSetController()
   {
       $route = $this->getRouteInterface();
       $route->setController("Foo/Foo/");
       $this->assertTrue("Foo/Foo" === $route->getController());
   }

   /**
    * Test RouteInterface::setController Exception
    *
    * @dataProvider setPrefixExceptionProvider
    * @expectedException \InvalidArgumentException
    */
   public final function testSetControllerException(string $controller)
   {
       $this->getRouteInterface()->setController($controller);
   }

   /**
    * setPrefixExceptionProvider
    */
   public final function setPrefixExceptionProvider()
   {
       return [["/"],  ["foo"], ["foo/"], ["/foo"]];
   }

   /**
    * Test RouteInterface::setParam
    */
   public final function testSetParam()
   {
       $route = $this->getRouteInterface();
       $param = ["foo" => "bar", "bar" => "baz"];
       $route->setParam($param);
       $this->assertTrue($param === $route->getParam());
   }

   /**
    * Test RouteInterface::setParam Exception
    *
    * @dataProvider setParamExceptionProvider
    * @expectedException \InvalidArgumentException
    */
   public final function testSetParamException(array $param)
   {
       $this->getRouteInterface()->setParam($param);
   }

   /**
    * setParamExceptionProvider
    */
   public final function setParamExceptionProvider()
   {
       return [
           [["foo" => true]],   
           [["foo" => []]],
           [["foo" => new stdClass()]]
       ];
   }

   /**
    * Test RouteInterface::setPath
    */
   public final function testSetPath()
   {
       $route = $this->getRouteInterface();
       $path = "/foo/bar/";
       $route->setPath($path);
       $this->assertTrue($path === $route->getPath());
   }

}
