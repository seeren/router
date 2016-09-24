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
 * @version 1.0.1
 */

namespace Seeren\Router\Matcher;

use Psr\Http\Message\ServerRequestInterface;
use Seeren\Router\Route\RouteInterface;

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
   private function matchAttributs(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       if (($route->getAction() !== strtolower($request->getMethod())
        && !isset($request->getQueryParams()[$route::ATTR_ACTION])
        && $route->getAction()
       !== $request->getQueryParams()[$route::ATTR_ACTION])
        || !isset($request->getQueryParams()[$route::ATTR_PREFIX])
        || !isset($request->getQueryParams()[$route::ATTR_CONTROLLER])
        || $request->getQueryParams()[$route::ATTR_PREFIX]
       !== strtolower($route->getPrefix())
        || $request->getQueryParams()[$route::ATTR_CONTROLLER]
       !== strtolower($route->getController())) {
            return false;
       }
       $request = $request
                  ->withAttribute(
                      $route::ATTR_ACTION,
                      $route->getAction())
                  ->withAttribute(
                      $route::ATTR_PREFIX,
                      $route->getPrefix())
                  ->withAttribute(
                      $route::ATTR_CONTROLLER,
                      $route->getController());
        return true;
   }

   /**
    * Match route param
    * 
    * @param ServerRequestInterface $request request
    * @param RouteInterface $route route 
    * @return bool route param match or not
    */
   private function matchParam(
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
           $request = $request
                      ->withAttribute($key, $request->getQueryParams()[$key]);
       }
       $request = $request->withAttribute(
           $route::ATTR_PARAM,
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
   private function matchPath(
       ServerRequestInterface &$request,
       RouteInterface $route): bool
   {
       $path = $route->getPath();
       foreach ($route->getParam() as $key => &$value) {
           $path = str_replace(
                   "{" . $key . "}",
                   $request->getQueryParams()[$key],
                   $path);
       }
       if ($path !== $request->getUri()->getPath()) {
           return false;
       }
       $request = $request->withAttribute($route::ATTR_PATH, $path);
       return true;
   }

}
