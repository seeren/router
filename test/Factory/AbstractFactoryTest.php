<?php

/**
 * This file contain Seeren\Router\Test\Factory\AbstractFactoryTest class
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

namespace Seeren\Router\Test\Factory;

use Seeren\Router\Route\RouteInterface;
use Seeren\Router\Factory\RouteFactory;
use Seeren\Router\Factory\RouteFactoryInterface;

/**
 * Class for test RouteFactoryInterface
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Factory
 * @abstract
 */
abstract class AbstractFactoryTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get RouteFactoryInterface
    * 
    * @return RouteFactoryInterface route factory
    */
   abstract protected function getRouteFactory(): RouteFactoryInterface;

   /**
    * Test create
    */
   public function testCreate()
   {
       $this->assertTrue(
           $this->getRouteFactory()
           ->create(
               "get",
               "Prefix",
               "Controller",
               [],
               "/"
           ) instanceof RouteInterface
       );
   }

   /**
    * Test create InvalidArgumentException
    */
   public function testCreateInvalidArgumentException()
   {
       $this->getRouteFactory()
       ->create(
           "get",
           "invalidPrefix",
           "Controller",
           [],
           "/"
       );
   }

}
