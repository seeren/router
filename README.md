# Seeren\\Router

[![Build](https://app.travis-ci.com/seeren/http.svg?branch=master)](https://app.travis-ci.com/seeren/router)
[![Require](https://poser.pugx.org/seeren/router/require/php)](https://packagist.org/packages/seeren/router)
[![Coverage](https://coveralls.io/repos/github/seeren/error/badge.svg?branch=master)](https://coveralls.io/github/seeren/router?branch=master)
[![Download](https://img.shields.io/packagist/dt/seeren/router.svg)](https://packagist.org/packages/seeren/router/stats)
[![Codacy](https://app.codacy.com/project/badge/Grade/10976d0537c3454e93242cec13bc07fb)](https://www.codacy.com/gh/seeren/router/dashboard?utm_source=github.com&utm_medium=referral&utm_content=seeren/router&utm_campaign=Badge_Grade)

Route http requests to controller actions

* * *

## Installation

```bash
composer require seeren/router
```

* * *

## Seeren\\Router\\Router

```php
namespace App\Controller;

use Seeren\Controller\JsonController;
use Seeren\Router\Route\Route;

class FooController extends JsonController
{

    #[Route("/path/(\d+)", "GET")]
    public function show(int $id)
    {
        return $this->render([]);
    }

}
```

Retrieve `\Psr\Http\Message\ResponseInterface` from a routed controller

```php
use Seeren\Router\Router;

$router = new Router();
$response = $router->getResponse();
```

* * *

## Configuration

Router use container configuration to inject arguments as primitve: <https://github.com/seeren/container#interfaces>

```bash
project/
└─ config/
   └─ services.json
   └─ routes.json
```

_config/services.json_

```bash
{
  "parameters": {},
  "services": {}
}
```

Controllers are resolved using anotation by default or configuration file. Captured matches are passed to controller action that can either use autowire

_config/routes.json_

```json
[
  {
    "path": "/path/(\\d+)",
    "controller": "App\\Controller\\FooController::show"
  }
]
```

* * *

## License

This project is licensed under the [MIT](./LICENSE) License
