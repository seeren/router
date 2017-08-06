<?php

/**
 * This file contain Seeren\Router\Test\RouterTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/router
 * @version 1.0.1
 */

namespace Seeren\Router\Test;

use Seeren\Router\RouterInterface;
use Seeren\Router\Factory\RouteFactory;
use Seeren\Router\Route\Route;
use Seeren\Router\Matcher\Matcher;
use Seeren\Router\Router;
use ReflectionClass;

/**
 * Class for test Router
 * 
 * @category Seeren
 * @package Routerr
 * @subpackage Test\Router
 */
class RouterTest extends AbstractRouterTest
{

   /**
    * Get RouterInterface
    * 
    * @return RouterInterface router
    */
    protected function getRouter(): RouterInterface
    {
        return (new ReflectionClass(Router::class))->newInstanceArgs([
            (new ReflectionClass(RouteFactory::class))->newInstanceArgs([
                (new ReflectionClass(Route::class))->newInstanceArgs([])
            ]),
            (new ReflectionClass(Matcher::class))->newInstanceArgs([])
        ]);
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::create
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::clone
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Router::create
     */
    public function testCreate()
    {
        parent::testCreate();
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::create
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::clone
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Router::create
     * @expectedException InvalidArgumentException
     */
    public function testCreateInvalidArgumentException()
    {
        parent::testCreateInvalidArgumentException();
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::create
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::clone
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Router::add
     * @covers \Seeren\Router\Router::create
     */
    public function testAdd()
    {
        parent::testAdd();
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::create
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::clone
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Router::add
     * @covers \Seeren\Router\Router::create
     * @covers \Seeren\Router\Router::import
     */
    public function testImport()
    {
        parent::testImport();
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Router::import
     * @expectedException InvalidArgumentException
     */
    public function testImportInvalidArgumentException()
    {
        parent::testImportInvalidArgumentException();
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::create
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @covers \Seeren\Router\Matcher\Matcher::matchAction
     * @covers \Seeren\Router\Matcher\Matcher::matchPath
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::clone
     * @covers \Seeren\Router\Route\Route::getAction
     * @covers \Seeren\Router\Route\Route::getParam
     * @covers \Seeren\Router\Route\Route::getPath
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     * @covers \Seeren\Router\Route\Route::setPrefix
     * @covers \Seeren\Router\Router::add
     * @covers \Seeren\Router\Router::create
     * @covers \Seeren\Router\Router::match
     */
    public function testMatch()
    {
        parent::testMatch();
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Exception\RouterException::__construct
     * @covers \Seeren\Router\Factory\RouteFactory::__construct
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Router::match
     * @expectedException \Seeren\Router\Exception\RouterException
     */
    public function testMatchRouterException()
    {
        $request = $this->getServerRequest();
        $this->getRouter()->match($request);
    }

}
