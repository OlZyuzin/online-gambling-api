<?php

namespace OlZyuzin\Http\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzinFramework\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LoadTestAction implements ActionInterface
{
    public function checkAuthorized(RequestInterface $request): bool
    {
       return true;
    }

    public function perform(RequestInterface $request): ResponseInterface
    {
        return new JsonResponse(['data' => ['status' => 'success']]);
    }

}