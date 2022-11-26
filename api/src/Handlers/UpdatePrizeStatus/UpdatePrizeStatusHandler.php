<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use OlZyuzin\Handlers\Dto\UpdatePrizeStatusDto;
use OlZyuzin\Handlers\Interfaces\UpdatePrizeStatusInterface;
use OlZyuzin\Models\Prize\Prize;
use OlZyuzin\Models\Prize\PrizeType;
use OlZyuzin\Repositories\Interfaces\PrizeRepositoryInterface;

class UpdatePrizeStatusHandler
{
    private array $handlers;

    public function __construct(
        private PrizeRepositoryInterface $prizeRepository,
        UpdatePrizeThingStatusHandler $updatePrizeThingStatusHandler,
        UpdatePrizeMoneyStatusHandler $updatePrizeMoneyStatusHandler,
    )
    {
        $this->handlers = [
            PrizeType::Thing() => $updatePrizeThingStatusHandler,
            PrizeType::Money() => $updatePrizeMoneyStatusHandler,
        ];
    }

    public function handle(
        int                $prizeId,
        UpdatePrizeStatusDto $dto,
    ): Prize {
        $prize = $this->prizeRepository->findPrize($prizeId);

        $handler = $this->getHandler($prize->getType());

        $handler->handle(
            $prize->id,
            $dto->status,
        );

        return $prize;
    }

    private function getHandler(PrizeType $type): UpdatePrizeStatusInterface
    {
        return $this->handlers[$type()];
    }


}