<?php

namespace OlZyuzinFramework;

class Router
{
    public function __construct(
      private array $routes
    ) {
    }

    public function getActionClass($path): string
    {
        if (isset($this->routes[$path])) {
            $result = $this->routes[$path];
        } else {
            $result = NotFoundAction::class;
        }

        return $result;
    }
}