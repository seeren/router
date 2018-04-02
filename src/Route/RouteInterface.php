<?php

/**
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @author (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/router
 * @version 1.0.2
 */
namespace Seeren\Router\Route;

/**
 * Interface for represente a route
 *
 * @category Seeren
 * @package Router
 * @subpackage Route
 */
interface RouteInterface
{

    const

        /**
         * @var string
         */
        ACTION = "action",
        
        /**
         * @var string
         */
        PREFIX = "prefix",
        
        /**
         * @var string
         */
        CONTROLLER = "controller", /**
    
        /**
         * @var string
         */
        PARAM = "param", /**
    
        /**
         * @var string
         */
        PATH = "path";

    /**
     * Get instance
     *
     * @return RouteInterface instance     
     */
    public function clone(): RouteInterface;

    /**
     * Get action
     *
     * @return string action
     */
    public function getAction(): string;

    /**
     * Set action
     *
     * @param string $action
     * @return RouteInterface
     */
    public function setAction(string $action): RouteInterface;

    /**
     * Get prefix
     *
     * @return string prefix
     */
    public function getPrefix(): string;

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return RouteInterface
     *        
     * @throws \InvalidArgumentException for invalid prefix
     */
    public function setPrefix(string $prefix): RouteInterface;

    /**
     * Get controller
     *
     * @return string controller
     */
    public function getController(): string;

    /**
     * Set controller
     *
     * @param string $controller
     * @return RouteInterface
     *        
     * @throws \InvalidArgumentException for invalid controller
     */
    public function setController(string $controller): RouteInterface;

    /**
     * Get param
     *
     * @return string param
     */
    public function getParam(): array;

    /**
     * Set param
     *
     * @param array $param
     * @return RouteInterface
     */
    public function setParam(array $param): RouteInterface;

    /**
     * Get path
     *
     * @return string path
     */
    public function getPath(): string;

    /**
     * Set path
     *
     * @param string $path
     * @return RouteInterface
     *        
     * @throws \InvalidArgumentException for invalid path
     */
    public function setPath(string $path): RouteInterface;

    /**
     * To string
     *
     * @return string namespace
     */
    public function __toString(): string;

}
