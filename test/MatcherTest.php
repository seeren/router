<?php

namespace Seeren\Router\Test;

use PHPUnit\Framework\TestCase;
use Seeren\Router\Exception\MethodException;
use Seeren\Router\Exception\RouteException;
use Seeren\Router\Matcher\Matcher;
use Seeren\Router\Matcher\MatcherInterface;
use Seeren\Router\Test\Mock\Controller\FooController;

class MatcherTest extends TestCase
{

    /**
     * @return MatcherInterface
     */
    public function getMock(): MatcherInterface
    {
        return new Matcher();
    }

    /**
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @throws MethodException
     */
    public function testMatchPathOrControllerException(): void
    {
        $mock = $this->getMock();
        $this->expectException(RouteException::class);
        $mock->match([]);
    }

    /**
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @throws MethodException
     */
    public function testMatchActionException(): void
    {
        $mock = $this->getMock();
        $this->expectException(RouteException::class);
        $mock->match([
            'path' => '/foo',
            'controller' => FooController::class
        ]);
    }

}
