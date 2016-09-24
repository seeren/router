<?php

/**
 * This file contain Seeren\Router\RouteInterface interface
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

namespace Seeren\Router\Route;

/**
 * Interface for represente a route
 * 
 * @category Seeren
 * @package Router
 * @subpackage Route
 */
interface RouteInterface
{

   const
       /**
        * @var string attribute name
        */
       ATTR_ACTION = "action",
       /**
        * @var string attribute name
        */
       ATTR_PREFIX = "prefix",
       /**
        * @var string attribute name
        */
       ATTR_CONTROLLER = "controller",
       /**
        * @var string attribute name
        */
       ATTR_PARAM = "param",
       /**
        * @var string attribute name
        */
       ATTR_PATH = "path";

   /**
    * Get instance
    *
    * @return RouteInterface instance
    *
    */
   public function clone(): RouteInterface;

   /**
    * Get action
    * 
    * @return string action
    */
   public function getAction(): string;

   /**
    * Set action
    *
    * @param string $action action
    * @return RouteInterface route
    * 
    * @throws InvalidArgumentException for invalid action
    */
   public function setAction(string $action): RouteInterface;

   /**
    * Get prefix
    * 
    * @return string prefix
    */
   public function getPrefix(): string;

   /**
    * Set prefix
    *
    * @param string $prefix prefix
    * @return RouteInterface route
    * 
    * @throws InvalidArgumentException for invalid prefix
    */
   public function setPrefix(string $prefix): RouteInterface;

   /**
    * Get controller
    * 
    * @return string controller
    */
   public function getController(): string;

   /**
    * Set controller
    *
    * @param string $controller controller
    * @return RouteInterface route
    * 
    * @throws InvalidArgumentException for invalid controller
    */
   public function setController(string $controller): RouteInterface;

   /**
    * Get param
    * 
    * @return string param
    */
   public function getParam(): array;

   /**
    * Set param
    *
    * @param array $param param
    * @return RouteInterface route
    * 
    * @throws InvalidArgumentException for invalid param
    */
   public function setParam(array $param): RouteInterface;

   /**
    * Get path
    *
    * @return string path
    */
   public function getPath(): string;

   /**
    * Set path
    *
    * @param string $path path
    * @return RouteInterface route
    *
    * @throws InvalidArgumentException for invalid path
    */
   public function setPath(string $path): RouteInterface;

   /**
    * To string
    * 
    * @return string namespace
    */
   public function __toString(): string;

}
