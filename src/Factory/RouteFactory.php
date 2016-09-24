<?php

/**
 * This file contain Seeren\Router\Factory\RouteFactory class
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
use InvalidArgumentException;

/**
 * Class for represente a route
 * 
 * @category Seeren
 * @package Router
 * @subpackage Factory
 */
class RouteFactory implements RouteFactoryInterface
{

   protected
       /**
        * @var RouteInterface route
        */
       $proto;

   /**
    * Construct Route
    * 
    * @param RouteInterface $proto route
    * @return null
    */
   public function __construct(RouteInterface $proto)
   {
       $this->proto = $proto;
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
           return $this->proto
           ->clone()
           ->setAction($action)
           ->setPrefix($prefix)
           ->setController($controller)
           ->setParam($param)
           ->setPath($path);
       } catch (InvalidArgumentException $e) {
           throw new InvalidArgumentException(
               "Can't create route: " . $e->getMessage());
       }
   }

}
