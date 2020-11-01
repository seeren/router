# Seeren\Router

[![Build Status](https://travis-ci.org/seeren/router.svg?branch=master)](https://travis-ci.org/seeren/router) [![Coverage Status](https://coveralls.io/repos/github/seeren/router/badge.svg?branch=master)](https://coveralls.io/github/seeren/router?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/router.svg)](https://packagist.org/packages/seeren/router/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/router?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/router&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/router.svg)](https://packagist.org/packages/seeren/router#) [![Packagist](https://img.shields.io/packagist/l/seeren/log.svg)](LICENSE)

Route controller action to http messages

___

## Installation

```bash
composer require seeren/router
```

## Seeren\Router\Router

Retrieve `\Psr\Http\Message\ResponseInterface` from a routed controller

```php
use Seeren\Router\Router;

$router = new Router();
$response = $router->getResponse();
```

Controllers are resolved using configuration file by default in `/config/routes.json`

```json
[
  {
    "path": "/foo",
    "controller": "App\\Controller\\FooController::showAll"
  },
  {
    "path": "/foo/(\\d+)",
    "controller": "App\\Controller\\FooController::show"
  },
  {
    "path": "/foo/(\\d+)/edit",
    "controller": "App\\Controller\\FooController::edit", 
    "methods": "get, post"
  }
]
```

```bash
project/
└─ config/
   └─ routes.json
```

Captured matches are passed to controller action that can either use autowire

```php
namespace App\Controller\Controller;

use Seeren\Controller\JsonController;

class FooController extends JsonController
{

    public function show(int $id, FooService $fooService)
    {
        return $this->render([]);
    }

}
```

## License

This project is licensed under the MIT License