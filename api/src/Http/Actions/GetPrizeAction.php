<?php

namespace OlZyuzin\Http\Actions;

use OlZyuzinFramework\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetPrizeAction implements ActionInterface
{

    public function checkAuthorized(RequestInterface $request): bool
    {
        return true;
    }

    public function perform(RequestInterface $request): ResponseInterface
    {

    }
}