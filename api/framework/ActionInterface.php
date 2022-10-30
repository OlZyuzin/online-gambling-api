<?php

namespace OlZyuzinFramework;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ActionInterface
{
    public function checkAuthorized(RequestInterface $request): bool;

    public function perform(RequestInterface $request): ResponseInterface;
}