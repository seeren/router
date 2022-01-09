<?php

namespace Seeren\Router\Route;

use Attribute;

#[Attribute]
class Route implements RouteInterface
{

    private string $action;

    private string $controller;

    private array $methods;

    private array $matches;

    public function __construct(
        private string $path,
        string $methods = 'GET')
    {
        $this->methods = explode(',', strtoupper($methods));
        foreach ($this->methods as &$method) {
            $method = trim($method);
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getMatches(): array
    {
        return $this->matches;
    }


    public function setController(string $controller): void
    {
        $controllerInfo = explode('::', $controller);
        $this->controller = $controllerInfo[0];
        $this->action = $controllerInfo[1];
    }

    public function setMatches(array $matches): void
    {
        $this->matches = $matches;
    }

}
