[![Build Status](https://travis-ci.org/seeren/router.svg?branch=master)](https://travis-ci.org/seeren/router) [![GitHub license](https://img.shields.io/badge/license-MIT-orange.svg)](https://raw.githubusercontent.com/seeren/router/master/LICENSE) [![Packagist](https://img.shields.io/packagist/v/seeren/router.svg)](https://packagist.org/packages/seeren/router) [![Packagist](https://img.shields.io/packagist/dt/seeren/router.svg)](https://packagist.org/packages/seeren/router/stats)

# Seeren\Router\

Router matching with psr-7 and psr-11.
Create routes, Manage them and find the one matching with a server request. Use matching route for create http controllers using psr-11 as resolver.

## Seeren\Router\Router
Router need a matcher and a route factory, default factory use a proto. It can be used for manage route collection and find matching route for a psr-7 ServerRequestInterface.
```php
$router = new Router(new RouteFactory(new Route), new Matcher);
$router->addGet($route)
       ->addPost($route)
       ->addPut($route)
       ->addDelete($route);
```

A matching route for a server request can be find using match. Server request attributes are populated by matching params, path and action.
```php
try {
    $route = $router->match($request);
} catch (RouterException $e) {
}
```

## Seeren\Router\Dispatcher
Dispatcher use the router match method and a container for get the controller corresponding to the string route representation.
```php
$controller = (new Dispatcher($request))->dispatch($container, $router);
```

## Installation
Require this package with composer
```
composer require seeren/router dev-master
```

## Run the tests
Run with phpunit after install dependencies
```
composer update
phpunit
```

## Authors
* **Cyril Ichti** - [www.seeren.fr](http://www.seeren.fr)