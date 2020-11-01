<?php

namespace Seeren\Router\Test\Mock\Controller;

use Psr\Http\Message\ResponseInterface;
use Seeren\Controller\JsonController;
use Seeren\Router\Test\Mock\Service\FooService;

class FooController extends JsonController
{

    public function showAll(FooService $fooService): ResponseInterface
    {
        unset($fooService);
        return $this->render([]);
    }

    public function show(int $id, FooService $fooService): ResponseInterface
    {
        unset($fooService);
        return $this->render(['id' => $id]);
    }

}
