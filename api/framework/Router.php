<?php

namespace OlZyuzinFramework;

class Router
{
    public function __construct(
      private array $routes
    ) {
    }

    public function getActionFqcn(string $path, string $httpMethod): string
    {
        $httpMethod = strtolower($httpMethod);
        if (!isset($this->routes[$path])) {
            return NotFoundAction::class;
        }

        $httpMethods = $this->routes[$path];

        if (!isset($httpMethods[$httpMethod])) {
            return MethodNotAllowedAction::class;
        }

        return $httpMethods[$httpMethod];
    }
}