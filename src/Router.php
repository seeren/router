<?php

namespace Seeren\Router;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Seeren\Container\Container;
use Seeren\Router\Exception\NotFoundException;
use Seeren\Router\Matcher\Matcher;

/**
 * Class to represent a router
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Router
 */
class Router implements RouterInterface
{

    /**
     * @var string
     */
    private string $includePath;

    /**
     * @var array
     */
    private array $routes = [];

    /**
     * @param string|null $includePath
     * @throws InvalidArgumentException
     */
    public function __construct(string $includePath = null)
    {
        $this->includePath = $includePath ?? dirname(__FILE__, 5) . DIRECTORY_SEPARATOR . 'config';
        $filename = $this->includePath . DIRECTORY_SEPARATOR . 'routes.json';
        if (!is_file($filename) || false === ($routes = json_decode(file_get_contents($filename), true))) {
            throw new InvalidArgumentException('Invalid "' . $filename . '" configuration file');
        }
        $this->routes = $routes;
    }

    /**
     * {@inheritDoc}
     * @see RouterInterface::getResponse()
     */
    public function getResponse(): ResponseInterface
    {
        $matcher = new Matcher();
        foreach ($this->routes as $value) {
            if (!($route = $matcher->match($value))) {
                continue;
            }
            unset($matcher, $this->routes);
            return (new Container($this->includePath))->call(
                $route->getController(),
                $route->getAction(),
                $route->getMatches()
            );
        }
        throw new NotFoundException('No route found');
    }

}
