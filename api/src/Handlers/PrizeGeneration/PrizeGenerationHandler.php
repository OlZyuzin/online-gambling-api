<?php

namespace OlZyuzin\Handlers\PrizeGeneration;

use OlZyuzin\Handlers\Interfaces\PrizeGenerationInterface;
use OlZyuzin\Models\Prize\Prize;


class PrizeGenerationHandler implements PrizeGenerationInterface
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

    private function getRandomHandler(): PrizeGenerationInterface
    {
        $key = array_rand($this->prizeHandlers);
        return $this->prizeHandlers[$key];
    }


}