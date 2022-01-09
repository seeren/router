<?php

namespace Seeren\Router\Route;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

class RouteBuilder
{

    public final function buildFromConfigurationFile(string $filename, array &$routes): void
    {
        if (is_file($filename)) {
            $routesJson = json_decode(file_get_contents($filename));
            if (false === $routesJson) {
                throw new InvalidArgumentException('Invalid "' . $filename . '" configuration file');
            }
            if (null === $routesJson) {
                return;
            }
            foreach ($routesJson as $key => $json) {
                if (!property_exists($json, 'path')) {
                    throw new InvalidArgumentException('Invalid route "#' . $key . '" missing path property');
                }
                $route = new Route($json->path, $json->methods ?? 'GET');
                $route->setController($json->controller);
                $routes[] = $route;
            }
        }
    }

    public final function buildFromAnnotations(
        string $includePath,
        string $folder,
        array $namespaces,
        array &$routes
    ): void {
        $folderPath = $includePath . DIRECTORY_SEPARATOR . $folder;
        if (is_dir($folderPath)) {
            foreach (scandir($folderPath) as $scan) {
                if ('.' === $scan || '..' === $scan) {
                    continue;
                }
                $filename = $folderPath . DIRECTORY_SEPARATOR . $scan;
                if (is_file($filename)) {
                    $this->parseFilename($filename, $folder, $namespaces, $routes);
                } else if (is_dir($filename)) {
                    $this->buildFromAnnotations(
                        $includePath,
                        $folder . DIRECTORY_SEPARATOR . $scan,
                        $namespaces,
                        $routes
                    );
                }
            }
        }
    }

    private function parseFilename(
        string $filename,
        string $folder,
        array $namespaces,
        array &$routes
    ): void {
        foreach ($namespaces as $namespace) {
            $className = $namespace . str_replace('/', '\\', $folder) . '\\' . pathinfo($filename)['filename'];
            try {
                $reflection = new ReflectionClass($className);
                foreach ($reflection->getMethods() as $method) {
                    $routesAttribute = $method->getAttributes(Route::class);
                    if ($routesAttribute) {
                        $route = $routesAttribute[0]->newInstance();
                        $route->setController($className . '::' . $method->getName());
                        $routes[] = $route;
                    }
                }
                break;
            } catch (ReflectionException $e) {
                continue;
            }
        }
    }

}
