<?php

namespace OlZyuzinFramework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class NotFoundAction implements ActionInterface
{
    public function checkAuthorized(RequestInterface $request): bool
    {
       return true;
    }


    public function perform(RequestInterface $request): ResponseInterface
    {
        return new Response(
            404,
            body: 'Not found',
        );
    }
}