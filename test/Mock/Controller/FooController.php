<?php

namespace Seeren\Router\Test\Mock\Controller;

use Psr\Http\Message\ResponseInterface;
use Seeren\Controller\JsonController;

class FooController extends JsonController
{

    public function showAll(): ResponseInterface
    {
        return $this->render([]);
    }

    public function show(int $id): ResponseInterface
    {
        return $this->render(['id' => $id]);
    }

}
