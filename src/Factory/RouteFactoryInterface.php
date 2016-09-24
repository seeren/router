<?php

/**
 * This file contain Seeren\Router\Factory\RouteFactoryInterface interface
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

namespace Seeren\Router\Factory;

use Seeren\Router\Route\RouteInterface;

/**
 * Interface for represente a route factory
 * 
 * @category Seeren
 * @package Router
 * @subpackage Factory
 */
interface RouteFactoryInterface
{

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
       string $path): RouteInterface;

}
