# router
 [![Build Status](https://travis-ci.org/seeren/router.svg?branch=master)](https://travis-ci.org/seeren/router) [![Coverage Status](https://coveralls.io/repos/github/seeren/router/badge.svg?branch=master)](https://coveralls.io/github/seeren/router?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/router.svg)](https://packagist.org/packages/seeren/router/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/router?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/router&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/router.svg)](https://packagist.org/packages/seeren/router#) [![Packagist](https://img.shields.io/packagist/l/seeren/log.svg)](LICENSE)

**Map controllers to http mesages**

## Features
* Route http message

## Installation
Require this package with [composer](https://getcomposer.org/)
```
composer require seeren/router dev-master
```

## Router Usage

#### `Seeren\Router\Router`
Router can import routes declared in json
```php
$router->import("routes.json");
```
You should not manipulate the router because he is provided by the [application](https://github.com/seeren/application)
```php
$application
->useRoutes("foo.json")
->useRoutes("bar.json");
```
A route must have an action, prefix, controller, param and path
```json
{
  "errorRoute": {
    "action": "get,post,foo,bar",
    "prefix": "ACME",
    "controller": "Error",
    "param": {
      "status": "(4|5){1}[0-2]{1}[0-9]{1}"
    },
    "path": "/error/{status}"
  }
}
```
This route above provide ACME\Controller\Dummy for a request corresponding to the path and the method declared

## Dispatcher Usage

#### `Seeren\Router\Dispatcher\Dispatcher`

When a controller is resolved, the route matching with the request is available in attribute

```php
$route = $request->getAttribute("route");
```

## Run Unit tests
Install dependencies
```
composer update
```
Run [phpunit](https://phpunit.de/) with [Xdebug](https://xdebug.org/) enabled and [OPcache](http://php.net/manual/fr/book.opcache.php) disabled for coverage
```
./vendor/bin/phpunit
```
## Run Coverage
Install dependencies
```
composer update
```
Run [coveralls](https://coveralls.io/) for check coverage
```
./vendor/bin/coveralls -v
```

##  Contributors
* **Cyril Ichti** - *Initial work* - [seeren](https://github.com/seeren)

## License
This project is licensed under the **MIT License** - see the [license](LICENSE) file for details.