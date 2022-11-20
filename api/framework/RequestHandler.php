<?php

namespace OlZyuzinFramework;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzinFramework\Exceptions\HttpException;
use Psr\Container\ContainerInterface;
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
        $httpMethod = $request->getMethod();
        $actionClass = $this->router->getActionFqcn($path, $httpMethod);

        $action = $this->container->get($actionClass);
        if (!$action->checkAuthorized($request)) {
            $response = new Response(
                'Unauthorized',
                403,
            );
        } else {
            try {
                $response = $action->perform($request);
            } catch (HttpException $e) {
                $response = new JsonResponse(
                    [
                        'error' => $e->getClientMessage(),
                        'details' => $e->getDetailsForClient(),
                    ],
                    $e->getStatusCode(),
                );
            }
        }

        return $response;
    }
}