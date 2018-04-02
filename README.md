# router
 [![Build Status](https://travis-ci.org/seeren/router.svg?branch=master)](https://travis-ci.org/seeren/router) [![Coverage Status](https://coveralls.io/repos/github/seeren/router/badge.svg?branch=master)](https://coveralls.io/github/seeren/router?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/router.svg)](https://packagist.org/packages/seeren/router/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/router?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/router&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/router.svg)](https://packagist.org/packages/seeren/router#) [![Packagist](https://img.shields.io/packagist/l/seeren/log.svg)](LICENSE)

**Map controllers to http messages**
## Features
* Route http message to controller action
## Installation
Require this package with [composer](https://getcomposer.org/)
```
composer require seeren/router dev-master
```

## Usage
#### `Seeren\Router\Router`
Router can import routes
```php
$router->import("routes.json");
```

Routes declaration
```json
{
  "errorDocument": {
    "action": "get,post",
    "prefix": "App",
    "controller": "Error",
    "param": {
      "status": "(4|5){1}[0-2]{1}[0-9]{1}"
    },
    "path": "/error/{status}"
  }
}
```

Dispatcher build request attributes
```php
$status = $request->getAttribute("status");
```

## Run Tests
Run [phpunit](https://phpunit.de/) with [Xdebug](https://xdebug.org/) enable and [OPcache](http://php.net/manual/fr/book.opcache.php) disable
```
./vendor/bin/phpunit
```

## Run Coverage
Run [coveralls](https://coveralls.io/)
```
./vendor/bin/php-coveralls -v
```

## License
This project is licensed under the **MIT License** - see the [license](LICENSE) file for details.