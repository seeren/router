<?php

/**
 * This file contain Seeren\Router\Router class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.0.3
 */

namespace Seeren\Router;

use Psr\Http\Message\ServerRequestInterface;
use Seeren\Router\Route\Route;
use Seeren\Router\Route\RouteInterface;
use Seeren\Router\Factory\RouteFactoryInterface;
use Seeren\Router\Matcher\MatcherInterface;
use Seeren\Router\Exception\RouterException;
use InvalidArgumentException;

/**
 * Class for route controller
 * 
 * @category Seeren
 * @package Router
 */
class Router implements RouterInterface
{

   protected
       /**
        * @var RouteFactoryInterface factory
        */
       $factory,
       /**
        * @var MatcherInterface matcher
        */
       $matcher,
       /**
        * @var array RouteInterface collection
        */
       $route;

    /**
     * 
     * Construct Router
     * 
     * @param RouteFactoryInterface $factory route factory
     * @param MatcherInterface $matcher matcher
     * @return null
     * 
     * @throws InvalidArgumentException for bad configuration
     */
    public function __construct(
        RouteFactoryInterface $factory,
        MatcherInterface $matcher)
    {
        $this->factory = $factory;
        $this->matcher = $matcher;
        $this->route = [];
    }

   /**
    * Create route
    * 
    * @param string $action action
    * @param string $prefix prefix name
    * @param string $controller controller name
    * @param array $param expression
    * @param string $path path
    * @return RouteInterface route
    * 
    * @throws InvalidArgumentException on setter exception
    */
   public function create(
       string $action,
       string $prefix,
       string $controller,
       array $param,
       string $path): RouteInterface
   {
       try {
           return $this->factory->create(
               $action,
               $prefix,
               $controller,
               $param,
               $path);
       } catch (InvalidArgumentException $e) {
           throw $e;
       }
   }

   /**
    * Add route for
    *
    * @param Route $route route
    * @return RouterInterface router
    */
   public final function add(RouteInterface $route): RouterInterface
   {
       $this->route[] = $route;
       return $this;
   }

   /**
    * Add route for get action
    * 
    * @param Route $route route
    * @return RouterInterface router
    */
   public final function addGet(RouteInterface $route): RouterInterface
   {
       return $this->add($route->setAction("get"));
   }

   /**
    * Add route for delete action
    * 
    * @param Route $route route
    * @return RouterInterface router
    */
   public final function addDelete(RouteInterface $route): RouterInterface
   {     
        return $this->add($route->setAction("delete"));
   }
    
   /**
    * Add route for post action
    * 
    * @param Route $route route
    * @return RouterInterface router
    */
   public final function addPost(RouteInterface $route): RouterInterface
   {
        return $this->add($route->setAction("post"));
   }
    
   /**
    * Add route for put action
    * 
    * @param Route $route route
    * @return RouterInterface router
    */
   public final function addPut(RouteInterface $route): RouterInterface
   {
        return $this->add($route->setAction("put"));
   }

   /**
    * Match route
    *
    * @param ServerRequestInterface $request http request
    * @return RouteInterface route
    * 
    * @throws RouterException on failure
    */
   public final function match(ServerRequestInterface &$request): RouteInterface
   {
       foreach ($this->route as $value) {
           if ($this->matcher->match($request, $value)) {
               return $value;
           }
       }
       throw new RouterException(
           "Can't match "
         . $request->getUri()->getPath());
   }

   /**
    * Import JSON file configuration
    *
    * @param string $fileName file name
    * @return RouteInterface route
    * 
    * @throws InvalidArgumentException on faillure
    */
   public final function import(string $fileName): RouterInterface
   {
       try {
           if (!($config = json_decode(file_get_contents($fileName), true))) {
               throw new InvalidArgumentException(
                   "Can't set JSON : invalid " . $fileName);
           }
           foreach ($config as $value) {
               $this->add($this->create(
                   $value[Route::ACTION],
                   $value[Route::PREFIX],
                   $value[Route::CONTROLLER],
                   $value[Route::PARAM],
                   $value[Route::PATH]));
           }
       } catch (InvalidArgumentException $e) {
           throw $e;
       }
       return $this;
   }

}
