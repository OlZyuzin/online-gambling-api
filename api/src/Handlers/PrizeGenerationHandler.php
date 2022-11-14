<?php

namespace OlZyuzin\Handlers;

use OlZyuzin\Models\Prize;


class PrizeGenerationHandler
{
    public function __construct(
        private PrizeScoreGenerationHandler $prizeScoreGenerationHandler,
        private PrizeMoneyGenerationHandler $prizeMoneyGenerationHandler,
        private PrizeThingGenerationHandler $prizeThingGenerationHandler,
//        private EntityManagerInterface $em,
    ) {
    }

    public function handle(int $userId): Prize
    {
//        $prize = $this->prizeScoreGenerationHandler->handle($userId);

        $prize = $this->prizeMoneyGenerationHandler->handle($userId);

        return $prize;
    }
}