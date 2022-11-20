<?php

namespace OlZyuzinFramework\Exceptions;

use JetBrains\PhpStorm\Pure;

abstract class HttpException extends \Exception
{
    #[Pure] public function __construct(
        protected array $detailsForClient = [],
    )
    {
        $message = "";
        $code = 0;
        $previous = null;
        parent::__construct($message, $code, $previous);
    }

    abstract public function getStatusCode(): int;

    abstract public function getClientMessage(): string;

    public function getDetailsForClient(): array
    {
        return $this->detailsForClient;
    }


}