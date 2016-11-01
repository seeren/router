<?php

/**
 * This file contain Seeren\Router\Matcher\Matcher class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.0.2
 */

namespace Seeren\Router\Matcher;

use Psr\Http\Message\ServerRequestInterface;
use Seeren\Router\Route\RouteInterface;
use Seeren\Router\Route\Route;

/**
 * Class for match a route
 * 
 * @category Essentiel
 * @package Router
 * @subpackage Matcher
 */
class Matcher implements MatcherInterface
{

   /**
    * Construct Matcher
    * 
    * @return null
    */
   public function __construct()
   {
   }

   /**
    * Match route
    * 
    * @param ServerRequestInterface $request http request
    * @param RouteInterface $route route
    * @return bool route match or not
    */
   public function match(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       if ($this->matchAttributs($request, $route)
        && $this->matchParam($request, $route)
        && $this->matchPath($request, $route)) {
           return true;
       }
       return false;
   }

   /**
    * Match route attributs
    *
    * @param ServerRequestInterface $request request
    * @param RouteInterface $route route
    * @return bool route attributs match or not
    */
   private final function matchAttributs(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       $param = $request->getQueryParams();
       if (array_key_exists(Route::CONTROLLER, $param)
        && $param[Route::CONTROLLER] === strtolower($route->getController())
        && array_key_exists(Route::PREFIX, $param)
        && $param[Route::PREFIX] === strtolower($route->getPrefix())) {
            $actions = explode(", ", $route->getAction());
            $action = array_key_exists(Route::ACTION, $param)
                    ? $param[Route::ACTION]
                    : strtolower($request->getMethod());
            if (in_array($action, $actions)) {
                $request = $request
                ->withAttribute(Route::ACTION, $action)
                ->withAttribute(Route::PREFIX,  $route->getPrefix())
                ->withAttribute(Route::CONTROLLER, $route->getController());
                return true;
            }
       }
       return false;
   }

   /**
    * Match route param
    * 
    * @param ServerRequestInterface $request request
    * @param RouteInterface $route route 
    * @return bool route param match or not
    */
   private final function matchParam(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       foreach ($route->getParam() as $key => $value) {
           if (!isset($request->getQueryParams()[$key])
            || !preg_match(
                "/^" . $value . "$/",
                $request->getQueryParams()[$key])) {
               return false;
           }
           $request = $request->withAttribute(
                            $key,
                            $request->getQueryParams()[$key]);
       }
       $request = $request->withAttribute(
           $route::PARAM,
           $route->getParam());
       return true;
    }

   /**
    * Match route param
    *
    * @param ServerRequestInterface $request request
    * @param RouteInterface $route route
    * @return bool route param match or not
    */
   private final function matchPath(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       $path = $route->getPath();
       foreach ($route->getParam() as $key => $value) {
           $path = str_replace(
                   "{" . $key . "}",
                   $request->getQueryParams()[$key],
                   $path);
       }
       if ($path !== $request->getUri()->getPath()) {
           return false;
       }
       $request = $request->withAttribute($route::PATH, $path);
       return true;
   }

}
