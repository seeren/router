<?php

/**
 * This file contain Seeren\Router\Route interface
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.0.5
 */

namespace Seeren\Router\Route;

use InvalidArgumentException;

/**
 * Class for represente a route
 * 
 * @category Seeren
 * @package Router
 * @subpackage Route
 */
class Route implements RouteInterface
{

   protected
       /**
        * @var string action
        */
       $action,
       /**
        * @var string prefix name
        */
       $prefix,
       /**
        * @var string controller name
        */
       $controller,
       /**
        * @var array parameters expression
        */
       $param,
       /**
        * @var string UriInterface path
        */
       $path;

   /**
    * Construct Route
    * 
    * @return null
    */
   public function __construct()
   {
       $this->action = $this->prefix = $this->controller = $this->path = "";
       $this->param = [];
   }

   /**
    * Get an instance
    *
    * @return PrototypeInterface instance
    *
    */
   public final function clone(): RouteInterface
   {
       return clone $this;
   }

   /**
    * Get action
    *
    * @return string action
    */
    public final function getAction(): string
   {
       return $this->action;
   }

   /**
    * Set action
    *
    * @param string $action action
    * @return string action
    */
   public function setAction(string $action): RouteInterface
   {
       $this->action = strtolower($action);
       return $this;
   }

   /**
    * Get prefix
    * 
    * @return string prefix
    */
   public final function getPrefix(): string
    {
        return $this->prefix;
    }

   /**
    * Set prefix
    *
    * @param string $prefix prefix
    * @return RouteInterface route
    * 
    * @throws InvalidArgumentException for invalid prefix
    */
   public function setPrefix(string $prefix): RouteInterface
    {
        if (!preg_match(
                "/^([A-Z]{1}[a-zA-Z_0-9]{1,31}(\/{1})?){1,5}$/",
                $prefix)) {
            throw new InvalidArgumentException(
                "Can't set prefix: invalid prefix " . $prefix);
        }
        $this->prefix = rtrim($prefix, "/");
        return $this;
    }

   /**
    * Get controller
    * 
    * @return string controller
    */
   public final function getController(): string
   {
       return $this->controller;
   }

   /**
    * Set controller
    *
    * @param string $controller controller
    * @return string controller
    * 
    * @throws InvalidArgumentException for invalid controller
    */
   public function setController(string $controller): RouteInterface
   {
       if (!preg_match(
               "/^([A-Z]{1}[a-zA-Z_0-9]{1,31}(\/{1})?){1,3}$/",
               $controller)) {
           throw new InvalidArgumentException(
               "Can't set controller: invalid relative class name "
             . $controller);
       }
       $this->controller = rtrim($controller, "/");
       return $this;
   }

   /**
    * Get param
    * 
    * @return string param
    */
   public final function getParam(): array
   {
       return $this->param;
   }

   /**
    * Set param
    *
    * @param array $param param
    * @return string param
    */
   public function setParam(array $param): RouteInterface
   {
       $this->param = $param;
       return $this;
   }

   /**
    * Get path
    *
    * @return string path
    */
   public final function getPath(): string
   {
       return $this->path;
   }
    
   /**
    * Set path
    *
    * @param string $path path
    * @return RouteInterface route
    *
    * @throws InvalidArgumentException for invalid path
    */
   public function setPath(string $path): RouteInterface
   {
       if (!preg_match("/^([\w-_\.\/{}=&\?\[\]])+$/", $path)) {
           throw new InvalidArgumentException(
               "Can't set path: invalid UriInterface path " . $path);
       }
       $this->path = $path;  
       return $this; 
    }

   /**
    * To string
    *
    * @return string route to string
    */
   public function __toString(): string
   {
       return str_replace("/", "\\", $this->prefix
                                   . "\\" . ucfirst(self::CONTROLLER)
                                   . "\\" . $this->controller);
   }

}
