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
 * @version 2.0.1
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
        if ($this->matchAction($request, $route)
         && $this->matchPath($request, $route)) {
            $request = $request->withAttribute("route", $route);
            return true;
        }
        return false;
   }

  /**
   * Match action
   *
   * @param ServerRequestInterface $request request
   * @param RouteInterface $route route
   * @return bool route action match or not
   */
   private function matchAction(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       $requestParam = $request->getQueryParams();
       return in_array(
           (array_key_exists(Route::ACTION, $requestParam)
          ? $requestParam[Route::ACTION]
          : strtolower($request->getMethod())),
           explode(",", $route->getAction()));
   }

   /**
    * Match route path
    *
    * @param ServerRequestInterface $request request
    * @param RouteInterface $route route
    * @return bool route path match or not
    */
   private final function matchPath(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
      $requestPath = explode("/", $request->getUri()->getPath());
      $routePath = explode("/", $route->getPath());
      if (count($routePath) !== count($requestPath)) {
        return false;
      }
      foreach ($routePath as $key => $path) {
           if ($path === $requestPath[$key]) {
               continue;
           } 
           $param = ltrim(rtrim($path, "}"), "{");
            if (!array_key_exists($param, $route->getParam())
             || !preg_match(
                     "/^" . $route->getParam()[$param] . "$/",
                     $requestPath[$key]) ) {
                return false;
            }
            $request = $request->withAttribute($param, $requestPath[$key]);
      }
      return true;
   }

}
