<?php

/**
 * This file contain Seeren\Router\Test\Matcher\MatcherTest class
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

namespace Seeren\Router\Test\Matcher;

use Seeren\Router\Matcher\MatcherInterface;
use Seeren\Router\Matcher\Matcher;
use ReflectionClass;

/**
 * Class for test Matcher
 * 
 * @category Seeren
 * @package Matcherr
 * @subpackage Test\Matcher
 */
class MatcherTest extends AbstractMatcherTest
{

   /**
    * Get MatcherInterface
    * 
    * @return MatcherInterface matcher
    */
    protected function getMatcher(): MatcherInterface
    {
        return (new ReflectionClass(Matcher::class))->newInstanceArgs([]);
    }

    /**
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::match
     * @covers \Seeren\Router\Matcher\Matcher::matchAction
     * @covers \Seeren\Router\Matcher\Matcher::matchPath
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getAction
     * @covers \Seeren\Router\Route\Route::getParam
     * @covers \Seeren\Router\Route\Route::getPath
     * @covers \Seeren\Router\Route\Route::setAction
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     */
    public function testMatch()
    {
        parent::testMatch();
    }

    /**
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::matchAction
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getAction
     * @covers \Seeren\Router\Route\Route::setAction
     */
    public function testMatchAction()
    {
        parent::testMatchAction();
    }

    /**
     * @covers \Seeren\Router\Matcher\Matcher::__construct
     * @covers \Seeren\Router\Matcher\Matcher::matchPath
     * @covers \Seeren\Router\Route\Route::__construct
     * @covers \Seeren\Router\Route\Route::getParam
     * @covers \Seeren\Router\Route\Route::getPath
     * @covers \Seeren\Router\Route\Route::setParam
     * @covers \Seeren\Router\Route\Route::setPath
     */
    public function testMatchPath()
    {
        parent::testMatchPath();
    }

}
