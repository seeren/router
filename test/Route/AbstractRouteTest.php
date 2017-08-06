<?php

/**
 * This file contain Seeren\Router\Test\Route\AbstractRouteTest class
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

/**
 * Class for test RouteInterface
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Route
 * @abstract
 */
abstract class AbstractRouteTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get RouteInterface
    * 
    * @return RouteInterface route
    */
   abstract protected function getRoute(): RouteInterface;

   /**
    * Test to string
    */
   abstract public function test__toString();

   /**
    * Test clone
    */
   public function testClone()
   {
       $this->assertTrue($this->getRoute()->clone() instanceof RouteInterface);
   }

   /**
    * Test set action
    */
   public function testSetAction()
   {
       $action = "foo";
       $this->assertTrue(
           $action
       === $this->getRoute()->setAction(strtoupper($action))->getAction()
       );
   }

   /**
    * Test set prefix
    */
   public function testSetPrefix()
   {
       $prefix = "Foo";
       $this->assertTrue(
           $prefix
       === $this->getRoute()->setPrefix($prefix . "/")->getPrefix()
       );
   }

   /**
    * Test set prefix InvalidArgumentException
    */
   public function testSetPrefixInvalidArgumentException()
   {
       $this->getRoute()->setPrefix("notInStudlyCaps");
   }

   /**
    * Test set controller
    */
   public function testSetController()
   {
       $controller = "Foo";
       $this->assertTrue(
           $controller
       === $this->getRoute()->setController($controller . "/")->getController()
       );
   }

   /**
    * Test set controller InvalidArgumentException
    */
   public function testSetControllerInvalidArgumentException()
   {
       $this->getRoute()->setController("notInStudlyCaps");
   }

   /**
    * Test set param
    */
   public function testSetParam()
   {
       $param = [true];
       $this->assertTrue(
           $param
       === $this->getRoute()->setParam($param)->getParam()
       );
   }

   /**
    * Test set path
    */
   public function testSetPath()
   {
       $path = "uri/path";
       $this->assertTrue(
           $path
       === $this->getRoute()->setPath("/" . $path)->getPath()
       );
   }

   /**
    * Test set path InvalidArgumentException
    */
   public function testSetPathInvalidArgumentException()
   {
       $this->getRoute()->setPath("illegal uri path");
   }

}
