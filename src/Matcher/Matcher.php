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
    * {@inheritDoc}
    * @see \Seeren\Router\Matcher\MatcherInterface::match()
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
   * @param ServerRequestInterface $request request
   * @param RouteInterface $route route
   * @return bool route action match or not
   */
   private function matchAction(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       $requestParam = $request->getQueryParams();
       $action = array_key_exists(Route::ACTION, $requestParam)
               ? $requestParam[Route::ACTION]
               : strtolower($request->getMethod());
       if (in_array($action, explode(",", $route->getAction()))) {
           $request = $request->withAttribute(Route::ACTION, $action);
           return true;
       }
       return false;
   }

   /**
    * @param ServerRequestInterface $request request
    * @param RouteInterface $route route
    * @return bool route path match or not
    */
   private final function matchPath(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
      $path = explode("public/", $request->getUri());
      $requestPath = explode(
          "/", !array_key_exists(1, $path) ? $request->getUri()->getPath() : $path[1]
      );
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
