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

namespace Seeren\Router\Test\Dispatcher;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Container\ContainerInterface;
use Seeren\Router\Dispatcher\DispatcherInterface;
use Seeren\Http\Request\ServerRequest;
use Seeren\Http\Stream\ServerRequestStream;
use Seeren\Http\Uri\ServerRequestUri;
use Seeren\Router\Router;
use Seeren\Router\Factory\RouteFactory;
use Seeren\Router\Route\Route;
use Seeren\Router\Matcher\Matcher;
use Seeren\Container\Container;
use Seeren\Container\Resolver\ResolverContainer;
use Seeren\Container\Resolver\Constructor\TypeHintingResolver;
use Seeren\Container\Cache\CacheContainer;
use Seeren\Router\RouterInterface;
use Seeren\Controller\HttpControllerInterface;
use ReflectionClass;

/**
 * Class for test DispatcherInterface
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Dispatcher
 * @abstract
 */
abstract class AbstractDispatcherTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get DispatcherInterface
    * 
    * @return DispatcherInterface dispatcher
    */
   abstract protected function getDispatcher(): DispatcherInterface;

   /**
    * @return RouterInterface
    */
   protected function getRouter(): RouterInterface
   {
       return (new ReflectionClass(Router::class))->newInstanceArgs([
           (new ReflectionClass(RouteFactory::class))->newInstanceArgs([
               (new ReflectionClass(Route::class))->newInstanceArgs([])
           ]),
           (new ReflectionClass(Matcher::class))->newInstanceArgs([])
       ]);
   }

   /**
    * @return ServerRequestInterface
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
    * @return ContainerInterface
    */
   protected function getContainer(): ContainerInterface
   {
       return (new ReflectionClass(Container::class))
       ->newInstanceArgs([
           (new ReflectionClass(ResolverContainer::class))
           ->newInstanceArgs([
               (new ReflectionClass(TypeHintingResolver::class))
               ->newInstanceArgs([])
           ]),
           (new ReflectionClass(CacheContainer::class))
           ->newInstanceArgs([]),
       ]);
   }

   /**
    * test dispatch RouterException
    */
   public function testDispatchRouterException()
   {
       $this->getDispatcher()
       ->dispatch($this->getContainer(), $this->getRouter());
   }

   /**
    * test dispatch DispatcherException
    */
   public function testDispatchDispatcherException()
   {
       $request = $this->getServerRequest();
       $uri = $request->getUri();
       $request = $request
       ->withMethod("GET")
       ->withUri($uri->withPath("uri/path/404"));
       $router = $this->getRouter();
       $router->add($router->create(
           "get",
           "Prefix",
           "Controller",
           ["error" => "(4|5){1}[0-2]{1}[0-9]{1}"],
           "uri/path/{error}"));
       $dispatcher = $this->getDispatcher();
       $dispatcher->__construct($request);
       $dispatcher->dispatch($this->getContainer(), $router);
   }

   /**
    * test dispatch
    */
   public function testDispatch()
   {
       $request = $this->getServerRequest();
       $uri = $request->getUri();
       $request = $request
       ->withMethod("GET")
       ->withUri($uri->withPath("uri/path/404"));
       $router = $this->getRouter();
       $router->add($router->create(
           "get",
           "Seeren/Router/Test/Dispatcher",
           "DummyController",
           ["error" => "(4|5){1}[0-2]{1}[0-9]{1}"],
           "uri/path/{error}"));
       $dispatcher = $this->getDispatcher();
       $dispatcher->__construct($request);
       $this->assertTrue(
           $dispatcher->dispatch(
               $this->getContainer(), $router
           ) instanceof HttpControllerInterface
       );
   }

}

namespace Seeren\Router\Test\Dispatcher\Controller;

use Seeren\Controller\HttpController;

class DummyController extends HttpController
{
    
}
