<?php

namespace Seeren\Router;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Seeren\Container\Container;
use Seeren\Router\Exception\NotFoundException;
use Seeren\Router\Matcher\Matcher;
use Seeren\Router\Route\RouteBuilder;

class Router implements RouterInterface
{

    private string $includePath;

    private array $routes = [];

    public function __construct(string $includePath = null)
    {
        $this->includePath = ($includePath ?? dirname(__FILE__, 5)) . DIRECTORY_SEPARATOR;
        if (!( $composer = json_decode(@file_get_contents($this->includePath . 'composer.json'), true)) 
        || !array_key_exists('autoload', $composer) 
        || !array_key_exists('psr-4', $composer['autoload'])) {
            throw new InvalidArgumentException('Composer autoload psr-4 not found');
        }
        $routeBuilder = new RouteBuilder();
        $routeBuilder->buildFromConfigurationFile(
            $this->includePath . 'config' . DIRECTORY_SEPARATOR . 'routes.json', 
            $this->routes
        );
        $routeBuilder->buildFromAnnotations(
            $this->includePath . 'src',
            'Controller',
            array_keys($composer['autoload']['psr-4']),
            $this->routes
        );
    }

    public function getResponse(): ResponseInterface
    {
        $matcher = new Matcher();
        foreach ($this->routes as $value) {
            if (!($route = $matcher->match($value))) {
                continue;
            }
            unset($matcher, $this->routes);
            return (new Container($this->includePath . 'config'))->call(
                $route->getController(),
                $route->getAction(),
                $route->getMatches()
            );
        }
        throw new NotFoundException('No route found');
    }

}
