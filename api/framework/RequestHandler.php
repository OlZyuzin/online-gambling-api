<?php

namespace OlZyuzinFramework;

use OlZyuzin\Actions\Test1Action;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{
    public function __construct(
      private ContainerInterface $container,
        private Router $router,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        $actionClass = $this->router->getActionClass($path);

        $action = $this->container->get($actionClass);
        if (!$action->checkAuthorized($request)) {
            $response = new Response(
                'Unauthorized',
                403,
            );
        } else {
            $response = $action->perform($request);
        }

        return $response;
    }
}