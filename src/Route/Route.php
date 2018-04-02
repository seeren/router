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
        * @var string
        */
       $action,

       /**
        * @var string
        */
       $prefix,

       /**
        * @var string
        */
       $controller,

       /**
        * @var array
        */
       $param,

       /**
        * @var string
        */
       $path;

   /**
    * @constructor
    */
   public function __construct()
   {
       $this->action = $this->prefix = $this->controller = $this->path = "";
       $this->param = [];
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::clone()
    */
   public final function clone(): RouteInterface
   {
       return clone $this;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::getAction()
    */
    public final function getAction(): string
   {
       return $this->action;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::setAction()
    */
   public function setAction(string $action): RouteInterface
   {
       $this->action = strtolower($action);
       return $this;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::getPrefix()
    */
   public final function getPrefix(): string
    {
        return $this->prefix;
    }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::setPrefix()
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
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::getController()
    */
   public final function getController(): string
   {
       return $this->controller;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::setController()
    */
   public function setController(string $controller): RouteInterface
   {
       if (!preg_match(
               "/^([A-Z]{1}[a-zA-Z_0-9]{1,31}(\/{1})?){1,3}$/",
               $controller)) {
           throw new InvalidArgumentException(
               "Can't set controller: invalid relative controller class name "
             . $controller);
       }
       $this->controller = rtrim($controller, "/");
       return $this;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::getParam()
    */
   public final function getParam(): array
   {
       return $this->param;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::setParam()
    */
   public function setParam(array $param): RouteInterface
   {
       $this->param = $param;
       return $this;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::getPath()
    */
   public final function getPath(): string
   {
       return $this->path;
   }
    
   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::setPath()
    */
   public function setPath(string $path): RouteInterface
   {
       if (!preg_match("/^([\w-\.\/{}=&\?\[\]])+$/", $path)) {
           throw new InvalidArgumentException(
               "Can't set path: invalid UriInterface path " . $path);
       }

       $this->path = ltrim($path, "/");
       return $this; 
    }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Route\RouteInterface::__toString()
    */
   public function __toString(): string
   {
       return str_replace(
           "/",
           "\\",
           $this->prefix . "\\"
         . ucfirst(self::CONTROLLER) . "\\" . $this->controller
       );
   }

}
