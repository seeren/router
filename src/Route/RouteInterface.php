<?php

namespace Seeren\Router\Route;

/**
 * Interface to represent a route
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Router\Route
 */
interface RouteInterface
{

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return string
     */
    public function getController(): string;

    /**
     * @return array
     */
    public function getMethods(): array;

    /**
     * @return array
     */
    public function getMatches(): array;

    /**
     * @param array $slugs
     */
    public function setMatches(array $slugs): void;

}
