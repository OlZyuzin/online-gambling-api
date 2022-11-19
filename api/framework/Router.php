<?php

namespace OlZyuzinFramework;

class Router
{
    public function __construct(
      private array $routes
    ) {
    }

    public function getActionFqcn($path, $httpMethod): string
    {
        if (!isset($this->routes[$path])) {
            return NotFoundAction::class;
        }
        /** @var Route $route */
        $route = $this->routes[$path];

        if ($route->httpMethod !== strtolower($httpMethod)) {
            return MethodNotAllowedAction::class;
        }

        return $route->actionFqcn;
    }
}