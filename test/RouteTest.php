<?php

namespace Seeren\Router\Test;

use PHPUnit\Framework\TestCase;
use Seeren\Router\Route\Route;

class RouteTest extends TestCase
{

    public function getMock(): Route
    {
        return new Route('/foo', 'GET, POST');
    }

    /**
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getPath
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\Route::getController
     * @covers \Seeren\Router\Route\Route::getAction
     */
    public function testGetPath(): void
    {
        $route = $this->getMock();
        $route->setController('Foo::action');
        $this->assertTrue(
            '/foo' === $route->getPath()
                && 'Foo' === $route->getController()
                && 'action' === $route->getAction()
        );
    }

}
