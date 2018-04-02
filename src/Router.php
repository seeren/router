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
 * @version 1.0.7
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
        * @var RouteFactoryInterface
        */
       $factory,

       /**
        * @var MatcherInterface
        */
       $matcher,

       /**
        * @var array RouteInterface
        */
       $route;

    /**
     * @param RouteFactoryInterface $factory
     * @param MatcherInterface $matcher
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
    * {@inheritDoc}
    * @see \Seeren\Router\Factory\RouteFactoryInterface::create()
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
    * {@inheritDoc}
    * @see \Seeren\Router\RouterInterface::add()
    */
   public final function add(RouteInterface $route): RouterInterface
   {
       $this->route[] = $route;
       return $this;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\RouterInterface::match()
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
         . $request->getMethod() . " "
         . $request->getUri()->getPath());
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\RouterInterface::import()
    */
   public final function import(string $fileName): RouterInterface
   {
       if (file_exists($fileName)) {
           $config = json_decode(file_get_contents($fileName), true);
           foreach ($config as $value) {
               $this->add($this->create(
                   $value[Route::ACTION],
                   $value[Route::PREFIX],
                   $value[Route::CONTROLLER],
                   $value[Route::PARAM],
                   $value[Route::PATH]));
           }
           return $this;
       }
       throw new InvalidArgumentException(
          "Can't import: invalid \"" . $fileName . "\""
       );
   }

}
