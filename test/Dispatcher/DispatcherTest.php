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

namespace Seeren\Router\Test\Dispatcher;

use Seeren\Router\Dispatcher\DispatcherInterface;
use Seeren\Router\Dispatcher\Dispatcher;
use ReflectionClass;

/**
 * Class for test Dispatcher
 * 
 * @category Seeren
 * @package Dispatcherr
 * @subpackage Test\Dispatcher
 */
class DispatcherTest extends AbstractDispatcherTest
{

   /**
    * {@inheritDoc}
    * @see \Seeren\Router\Test\Dispatcher\AbstractDispatcherTest::getDispatcher()
    */
    protected function getDispatcher(): DispatcherInterface
    {
        $request = $this->getServerRequest();
        return (new ReflectionClass(Dispatcher::class))->newInstanceArgs([
            &$request
        ]);
    }

    /**
     * @covers \Seeren\Router\Dispatcher\Dispatcher::__construct
     * @covers \Seeren\Router\Dispatcher\Dispatcher::dispatch
     * @covers \Seeren\Router\Exception\RouterException::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Router::match
     * @expectedException \Seeren\Router\Exception\RouterException
     */
    public function testDispatchRouterException()
    {
        parent::testDispatchRouterException();
    }

    /**
     * @covers \Seeren\Router\Dispatcher\Dispatcher::__construct
     * @covers \Seeren\Router\Dispatcher\Dispatcher::dispatch
     * @covers \Seeren\Router\Exception\DispatcherException::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::create
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @covers \Seeren\Router\Matcher\Matcher::matchAction
     * @covers \Seeren\Router\Matcher\Matcher::matchPath
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::__toString
     * @covers \Seeren\Router\Route\Route::clone
     * @covers \Seeren\Router\Route\Route::getAction
     * @covers \Seeren\Router\Route\Route::getParam
     * @covers \Seeren\Router\Route\Route::getPath
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Router::add
     * @covers \Seeren\Router\Router::create
     * @covers \Seeren\Router\Router::match
     * @expectedException \Seeren\Router\Exception\DispatcherException
     */
    public function testDispatchDispatcherException()
    {
        parent::testDispatchDispatcherException();
    }

    /**
     * @covers \Seeren\Router\Dispatcher\Dispatcher::__construct
     * @covers \Seeren\Router\Dispatcher\Dispatcher::dispatch
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::create
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @covers \Seeren\Router\Matcher\Matcher::matchAction
     * @covers \Seeren\Router\Matcher\Matcher::matchPath
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::__toString
     * @covers \Seeren\Router\Route\Route::clone
     * @covers \Seeren\Router\Route\Route::getAction
     * @covers \Seeren\Router\Route\Route::getParam
     * @covers \Seeren\Router\Route\Route::getPath
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Router::add
     * @covers \Seeren\Router\Router::create
     * @covers \Seeren\Router\Router::match
     */
    public function testDispatch()
    {
        parent::testDispatch();
    }

}
