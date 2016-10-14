<?php

/**
 * This file contain Seeren\Router\Route\Test\RouteInterfaceTest class
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

use Seeren\Http\Request\ServerRequest;
use Seeren\Http\Stream\ServerRequestStream;
use Seeren\Http\Uri\ServerRequestUri;
use Seeren\Router\Route\RouteInterface;
use Seeren\Router\RouterInterface;
use Seeren\Router\Route\Route;
use Seeren\Router\Exception\RouterException;
use ReflectionClass;

/**
 * Class for test RouterInterface
 * 
 * @category Seeren
 * @package Router
 * @subpackage Route\Test
 * @abstract
 */
abstract class RouterInterfaceTest extends \PHPUnit_Framework_TestCase
{

   /**
    * Get RouterInterface
    * 
    * @return RouterInterface router
    */
   abstract protected function getRouterInterface(): RouterInterface;

   /**
    * Test RouterInterface::create
    */
   public final function testCreate()
   {
       $this->assertTrue(
           $this->getRouterInterface()->create(
               "get", "Prefix", "Controller", [], "index.php"
           ) instanceof RouteInterface
       );
   }

   /**
    * Test RouterInterface::add
    */
   public final function testAdd()
   {
       $router = $this->getRouterInterface();
       $route = (new ReflectionClass(Route::class))->newInstanceArgs([]);
       $routerAdd = $this->getRouterInterface()->add($route);
       $this->assertTrue($router !== $routerAdd);
   }

   /**
    * Test RouterInterface::addGet
    */
   public final function testAddGet()
   {
       $router = $this->getRouterInterface();
       $route = (new ReflectionClass(Route::class))->newInstanceArgs([]);
       $router->addGet($route);
       $this->assertTrue($route->getAction() === "get");
   }

   /**
    * Test RouterInterface::addPost
    */
   public final function testAddPost()
   {
       $router = $this->getRouterInterface();
       $route = (new ReflectionClass(Route::class))->newInstanceArgs([]);
       $router->addPost($route);
       $this->assertTrue($route->getAction() === "post");
   }

   /**
    * Test RouterInterface::addPut
    */
   public final function testAddPut()
   {
       $router = $this->getRouterInterface();
       $route = (new ReflectionClass(Route::class))->newInstanceArgs([]);
       $router->addPut($route);
       $this->assertTrue($route->getAction() === "put");
   }

   /**
    * Test RouterInterface::addDelete
    */
   public final function testAddDelete()
   {
       $router = $this->getRouterInterface();
       $route = (new ReflectionClass(Route::class))->newInstanceArgs([]);
       $router->addDelete($route);
       $this->assertTrue($route->getAction() === "delete");
   }

   /**
    * Test RouterInterface::match
    */
   public final function testMatch()
   {
       $router = $this->getRouterInterface();
       $route = $router->create("get", "Foo", "Bar", ["id" => "[0-9]{1}"], "{id}");
       $router->add($route);
       $request = (new ReflectionClass(ServerRequest::class))->newInstanceArgs([
           (new ReflectionClass(ServerRequestStream::class))->newInstanceArgs([]),
           (
               new ReflectionClass(ServerRequestUri::class))->newInstanceArgs([]
           )->withPath("5")
       ])->withQueryParams(
           ["prefix" => "foo", "controller" => "bar", "id" => "5"]
       );
       $this->assertTrue($route === $router->match($request));
   }

   /**
    * Test RouterInterface::match Exception
    * 
    * @expectedException Seeren\Router\Exception\RouterException
    */
   public final function testMatchException()
   {
       $router = $this->getRouterInterface();
       $request = (new ReflectionClass(ServerRequest::class))->newInstanceArgs([
           (new ReflectionClass(ServerRequestStream::class))->newInstanceArgs([]),
           (new ReflectionClass(ServerRequestUri::class))->newInstanceArgs([])
       ]);
       $router->match($request);
   }

}
