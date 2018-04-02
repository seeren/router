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

namespace Seeren\Router\Test\Matcher;

use Seeren\Router\Matcher\MatcherInterface;
use Psr\Http\Message\ServerRequestInterface;
use Seeren\Http\Request\ServerRequest;
use Seeren\Http\Stream\ServerRequestStream;
use Seeren\Http\Uri\ServerRequestUri;
use Seeren\Router\Route\Route;
use Seeren\Router\Route\RouteInterface;
use Seeren\Router\Matcher\Matcher;
use ReflectionClass;

/**
 * Class for test MatcherInterface
 * 
 * @category Seeren
 * @package Router
 * @subpackage Test\Matcher
 * @abstract
 */
abstract class AbstractMatcherTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get MatcherInterface
    * 
    * @return MatcherInterface matcher
    */
   abstract protected function getMatcher(): MatcherInterface;

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
          ]
        );
    }

    /**
     * @return RouteInterface
     */
    protected function getRoute(): RouteInterface
    {
        return (new ReflectionClass(Route::class))->newInstanceArgs([]);
    }

    /**
     * Test match
     */
    public function testMatch()
    {
        $matcher = $this->getMatcher();
        $request = $this->getServerRequest();
        $uri = $request->getUri();
        $route = $this->getRoute()
        ->setAction("get")
        ->setParam(["error" => "(4|5){1}[0-2]{1}[0-9]{1}"])
        ->setPath("uri/path/{error}");
        $matchingRequest = $request
        ->withMethod("GET")
        ->withUri($uri->withPath("uri/path/404"));
        $this->assertTrue(
            $matcher->match($request, $route) === false
         && $matcher->match($matchingRequest, $route) === true
        );
    }

    /**
     * Test match action
     */
   public function testMatchAction()
   {
       $matcher = $this->getMatcher();
       $request = $this->getServerRequest();
       $getRequest = $request->withMethod("get");
       $fooRequest = $request->withQueryParams(["action" => "foo"]);
       $route = $this->getRoute();
       $class = new ReflectionClass(Matcher::class);
       $method = $class->getMethod("matchAction");
       $method->setAccessible(true);
       $this->assertTrue(
           $method->invokeArgs(
               $matcher, [&$request, $route->setAction("foo")]
            ) === false
         && $method->invokeArgs(
               $matcher, [&$getRequest, $route->setAction("get")]
            ) === true
         && $method->invokeArgs(
               $matcher, [&$fooRequest, $route->setAction("foo")]
            ) === true
       );
   }

    /**
     * Test match path
     */
   public function testMatchPath()
   {
       $matcher = $this->getMatcher();
       $request = $this->getServerRequest();
       $uri = $request->getUri();
       $route = $this->getRoute()
       ->setParam(["error" => "(4|5){1}[0-2]{1}[0-9]{1}"])
       ->setPath("uri/path/{error}");
       $request = $request->withUri($uri->withPath("uri/path"));
       $matchingRequest = $request->withUri($uri->withPath("uri/path/404"));
       $notMatchingRequest = $request->withUri($uri->withPath("uri/path/904"));
       $class = new ReflectionClass(Matcher::class);
       $method = $class->getMethod("matchPath");
       $method->setAccessible(true);
       $this->assertTrue(
           $method->invokeArgs(
               $matcher, [&$request, $route]
           ) === false
        && $method->invokeArgs(
               $matcher, [&$matchingRequest, $route]
            ) === true
        && $method->invokeArgs(
            $matcher, [&$notMatchingRequest, $route]
            ) === false
       );
   }

}
