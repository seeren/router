<?php

/**
 * This file contain Seeren\Router\Dispatcher\DispatcherInterface interface
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

namespace Seeren\Router\Dispatcher;

use Psr\Container\ContainerInterface;
use Seeren\Controller\ControllerInterface;
use Seeren\Router\RouterInterface;

/**
 * Interface for dispatch a controller
 * 
 * @category Seeren
 * @package Router
 * @subpackage Dispatcher
 */
interface DispatcherInterface
{

   /**
    * Dispatch route
    * 
    * @param ContainerInterface $container container
    * @param RouterInterface $router route handler
    * @return ControllerInterface controller dispatched
    * 
    * @throws RouterException no route match
    * @throws Dispatcher dispatching error
    */
   public function dispatch(
       ContainerInterface $container,
       RouterInterface $router): ControllerInterface;

}
