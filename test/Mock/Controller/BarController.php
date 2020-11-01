<?php

namespace Seeren\Router\Test\Mock\Controller;

use Psr\Http\Message\ResponseInterface;
use Seeren\Controller\MarkupController;
use Seeren\Http\Response\Response;
use Seeren\Http\Stream\Stream;

class BarController extends MarkupController
{

    public function showAll(): ResponseInterface
    {
        return new Response(new Stream('php://temps', Stream::MODE_R_MORE));
    }

}
