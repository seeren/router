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
 * @version 1.0.2
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
        * @var RouteInterface
        */
       $proto;

   /**
    * @param RouteInterface $proto route
    */
   public function __construct(RouteInterface $proto)
   {
       $this->proto = $proto;
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
           return $this->proto->clone()
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
