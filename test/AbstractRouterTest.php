<?php

/**
 * This file contain Seeren\Router\Test\AbstractRouterTest class
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

namespace Seeren\Router\Test;

use Psr\Http\Message\ServerRequestInterface;
use Seeren\Router\RouterInterface;
use Seeren\Router\Test\Factory\AbstractFactoryTest;
use Seeren\Router\Factory\RouteFactoryInterface;
use Seeren\Router\Route\RouteInterface;
use Seeren\Http\Request\ServerRequest;
use Seeren\Http\Stream\ServerRequestStream;
use Seeren\Http\Uri\ServerRequestUri;
use ReflectionClass;

/**
 * Class for test RouterInterface
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test
 * @abstract
 */
abstract class AbstractRouterTest extends AbstractFactoryTest
{

   /**
    * Get RouterInterface
    * 
    * @return RouterInterface router
    */
   abstract protected function getRouter(): RouterInterface;

   /**
    * Get RouteFactoryInterface
    *
    * @return RouteFactoryInterface route factory
    */
   protected function getRouteFactory(): RouteFactoryInterface
   {
       return $this->getRouter();
   }

   /**
    * Get ServerRequestInterface
    *
    * @return ServerRequestInterface request
    */
   protected function getServerRequest(): ServerRequestInterface
   {
       return (new ReflectionClass(ServerRequest::class))
       ->newInstanceArgs([
           (new ReflectionClass(ServerRequestStream::class))
           ->newInstanceArgs([]),
           (new ReflectionClass(ServerRequestUri::class))
           ->newInstanceArgs([]),
       ]);
   }

   /**
    * Test add 
    */
   public function testAdd()
   {
       $router = $this->getRouter();
       $this->assertTrue(
           $router
           ->add(
               $router->create(
                   "get",
                   "Prefix",
                   "Controller",
                   [],
                   "/"
               )
           ) instanceof RouterInterface
       );
   }

   /**
    * Test import
    */
   public function testImport()
   {
       $this->assertTrue(
           $this->getRouter()
           ->import("./test/route.json") instanceof RouterInterface
       );
   }

   /**
    * Test import InvalidArgumentException
    */
   public function testImportInvalidArgumentException()
   {
       $this->getRouter()->import("./invalid file");
   }

   /**
    * Test match
    */
   public function testMatch()
   {
       $request = $this->getServerRequest();
       $uri = $request->getUri();
       $matchingRequest = $request
        ->withMethod("GET")
        ->withUri($uri->withPath("uri/path/404"));
       $router = $this->getRouter();
       $router->add($router->create(
           "get",
           "Prefix",
           "Controller",
           ["error" => "(4|5){1}[0-2]{1}[0-9]{1}"],
           "uri/path/{error}"));
       $this->assertTrue(
           $router->match($matchingRequest) instanceof RouteInterface
       );
   }

   /**
    * Test match RouterException
    */
   public function testMatchRouterException()
   {
       $this->getRouter()->match($this->getServerRequest());
   }

}
