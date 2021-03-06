<?php

namespace Seeren\Router\Route;

use InvalidArgumentException;

/**
 * Class to represent a route
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Router\Route
 */
class Route implements RouteInterface
{

    /**
     * @var string
     */
    private string $path;

    /**
     * @var string
     */
    private string $action;

    /**
     * @var string
     */
    private string $controller;

    /**
     * @var array
     */
    private array $methods;

    /**
     * @var array
     */
    private array $matches;

    /**
     * @param string $path
     * @param string $action
     * @param string $methods
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $path,
        string $action,
        string $methods)
    {
        $controllerInfo = explode('::', $action);
        $this->controller = $controllerInfo[0];
        $this->action = $controllerInfo[1];
        $this->path = $path;
        $this->methods = explode(',', strtoupper($methods));
        foreach ($this->methods as &$value) {
            $value = trim($value);
        }
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }

    public function setMatches(array $matches): void
    {
        $this->matches = $matches;
    }

}
