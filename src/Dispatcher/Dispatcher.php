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
 * @version 1.0.1
 */

namespace Seeren\Router\Dispatcher;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Container\ContainerInterface;
use Seeren\Controller\ControllerInterface;
use Seeren\Router\RouterInterface;
use Seeren\Router\Exception\RouterException;
use Seeren\Router\Exception\DispatcherException;
use Throwable;

/**
 * Class for dispatch a controller
 * 
 * @category Seeren
 * @package Router
 * @subpackage Dispatcher
 */
class Dispatcher implements DispatcherInterface
{

   protected
       /**
        * @var ServerRequestInterface
        */
       $request;

   /**
    * @param ServerRequestInterface $request http server request
    */
   public function __construct(ServerRequestInterface $request)
   {
       $this->request = $request;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Dispatcher\DispatcherInterface::dispatch()
    */
   public final function dispatch(
       ContainerInterface $container,
       RouterInterface $router): ControllerInterface
   {
       try {
           $route = $router->match($this->request);
           if (method_exists($container, "set")) {
               $container->set(get_class($this->request), $this->request);
           }
           return $container->get($route->__toString());
       } catch (RouterException $e) {
           throw $e;
       } catch (Throwable $e) {
           throw new DispatcherException(
               "Can't dispatch: " . $e->getMessage());
       }
   }

}
