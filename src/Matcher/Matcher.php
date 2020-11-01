<?php

namespace Seeren\Router\Matcher;

use Seeren\Router\Exception\MethodException;
use Seeren\Router\Exception\RouteException;
use Seeren\Router\Route\Route;
use Seeren\Router\Route\RouteInterface;

/**
 * Class to represent a matcher
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Router
 */
class Matcher implements MatcherInterface
{

    /**
     * @var string
     */
    private string $path;

    /**
     * @var string
     */
    private string $method;

    /**
     * Matcher constructor
     */
    public function __construct()
    {
        $pathInfo = filter_input(INPUT_SERVER, 'PATH_INFO');
        $redirectUrl = filter_input(INPUT_SERVER, 'REDIRECT_URL');
        $queryString = filter_input(INPUT_SERVER, 'QUERY_STRING');
        $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $this->method = (string)filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $this->path = (string)($pathInfo ? $pathInfo : ($redirectUrl ? $redirectUrl : str_replace(
            '?' . $queryString,
            '',
            $requestUri
        )));
    }

    /**
     * {@inheritDoc}
     * @see MatcherInterface::match()
     */
    public function match(array $route): ?RouteInterface
    {
        if (!array_key_exists('path', $route) || !array_key_exists('controller', $route)) {
            throw new RouteException('Route must have a path and a controller');
        } else if (!strpos($route['controller'], '::')) {
            throw new RouteException('Invalid route action "' . $route['controller'] . '"');
        } else if (!array_key_exists('methods', $route)) {
            $route['methods'] = 'GET';
        }
        if (!preg_match('#^' . $route['path'] . '$#', $this->path, $matches)) {
            return null;
        }
        $route = new Route($route['path'], $route['controller'], $route['methods']);
        if (!in_array(strtoupper($this->method), $route->getMethods())) {
            throw new MethodException('Method "' . $this->method . '" not allowed');
        }
        array_shift($matches);
        $route->setMatches($matches);
        return $route;
    }

}
