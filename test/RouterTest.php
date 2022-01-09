<?php

namespace Seeren\Router\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Seeren\Router\Exception\MethodException;
use Seeren\Router\Exception\NotFoundException;
use Seeren\Router\Exception\RouteException;
use Seeren\Router\Router;
use Seeren\Router\RouterInterface;
use Throwable;

require __DIR__ . '/context.php';

class RouterTest extends TestCase
{

    public function getMock(string $includePath = null): RouterInterface
    {
        $includePath = $includePath ?? __DIR__;
        return new Router($includePath);
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     */
    public function testConstructionException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getMock('invalidPath');
    }

    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @covers \Seeren\Router\Router::getResponse
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getMethods
     * @covers \Seeren\Router\Route\RouteBuilder::buildFromAnnotations
     * @covers \Seeren\Router\Route\RouteBuilder::buildFromConfigurationFile
     */
    public function testGetResponseNotFound(): void
    {
        $this->expectException(NotFoundException::class);
        $router = $this->getMock(__DIR__ . '/config/not-found');
        $router->getResponse();
    }


    /**
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @covers \Seeren\Router\Router::getResponse
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getMethods
     * @covers \Seeren\Router\Route\Route::getPath
     * @covers \Seeren\Router\Route\Route::setController
     * @covers \Seeren\Router\Route\RouteBuilder::buildFromAnnotations
     * @covers \Seeren\Router\Route\RouteBuilder::buildFromConfigurationFile
     */
    public function testGetResponseBadMethod(): void
    {
        $this->expectException(MethodException::class);
        $router = $this->getMock(__DIR__ . '/config/bad-method');
        $router->getResponse();
    }

    /**
     * @runInSeparateProcess
     * @covers \Seeren\Router\Router::__construct
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @covers \Seeren\Router\Router::getResponse
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getAction
     * @covers \Seeren\Router\Route\Route::getController
     * @covers \Seeren\Router\Route\Route::getMatches
     * @covers \Seeren\Router\Route\Route::getMethods
     * @covers \Seeren\Router\Route\Route::setMatches
     */
    public function testGetResponse(): void
    {
        require __DIR__ . '/Mock/Controller/FooController.php';
        $this->expectOutputString('{"id":2}');
        $router = $this->getMock();
        $router->getResponse();
    }

}
