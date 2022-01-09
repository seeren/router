<?php

namespace Seeren\Router\Matcher;

use Seeren\Router\Exception\MethodException;
use Seeren\Router\Route\RouteInterface;

class Matcher implements MatcherInterface
{

    private string $path;

    private string $method;

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

    public function match(RouteInterface $route): ?RouteInterface
    {
        if (!preg_match('#^' . $route->getPath() . '$#', $this->path, $matches)) {
            return null;
        }
        if (!in_array(strtoupper($this->method), $route->getMethods())) {
            throw new MethodException('Method "' . $this->method . '" not allowed');
        }
        array_shift($matches);
        $route->setMatches($matches);
        return $route;
    }

}
