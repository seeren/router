<?php

namespace Seeren\Router\Test;

use PHPUnit\Framework\TestCase;
use Seeren\Router\Route\Route;
use Seeren\Router\Test\Mock\Controller\FooController;

class RouteTest extends TestCase
{

    /**
     * @return Route
     */
    public function getMock(): Route
    {
        return new Route('/foo', FooController::class . '::show', 'GET, POST');
    }

    /**
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getPath
     */
    public function testGetPath():void
    {
        $this->assertEquals('/foo', $this->getMock()->getPath());
    }

}
