<?php

namespace Seeren\Router\Route;

interface RouteInterface
{

    public function getPath(): string;

    public function getAction(): string;

    public function getController(): string;

    public function getMethods(): array;

    public function getMatches(): array;

    public function setController(string $controller): void;

    public function setMatches(array $matches): void;

}
