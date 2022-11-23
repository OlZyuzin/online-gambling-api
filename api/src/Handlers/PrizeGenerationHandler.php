<?php

namespace OlZyuzin\Handlers;

use OlZyuzin\Models\Prize\Prize;


class PrizeGenerationHandler implements PrizeGenerationHandlerInterface
{
    private array $prizeHandlers;

    public function __construct(
        PrizeScoreGenerationHandler $prizeScoreGenerationHandler,
        PrizeMoneyGenerationHandler $prizeMoneyGenerationHandler,
        PrizeThingGenerationHandler $prizeThingGenerationHandler,
    ) {
        $this->prizeHandlers[] = $prizeScoreGenerationHandler;
        $this->prizeHandlers[] = $prizeMoneyGenerationHandler;
        $this->prizeHandlers[] = $prizeThingGenerationHandler;
    }

    public function handle(int $userId): Prize
    {
        $handler = $this->getRandomHandler();
        $prize = $handler->handle($userId);

        return $prize;
    }

    private function getRandomHandler(): PrizeGenerationHandlerInterface
    {
        $key = array_rand($this->prizeHandlers);
        return $this->prizeHandlers[$key];
    }


}